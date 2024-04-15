const getServerDataSearch = async (isBedrock, serverIp) => {
  return new Promise(async (resolve, reject) => {
    try {
      const response = await fetch(
        `https://api.mcsrvstat.us${isBedrock}${serverIp}`
      );
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      const data = await response.json();
      resolve(data);
    } catch (error) {
      reject(error);
    }
  });
};

document
  .getElementById("searchForm")
  .addEventListener("submit", async function (event) {
    event.preventDefault();

    const serverIp = document.getElementById("searchInput").value;
    const activeOnly = document.getElementById("activeOnlyCheckbox").checked;

    const serverDataElement = document.querySelector(
      ".server-data-with-search-container"
    );
    let isBedrock = activeOnly ? "/bedrock/3/" : "/3/";
    try {
      const serverData = await getServerDataSearch(isBedrock, serverIp);

      serverDataElement.innerHTML = `
    <div class="server-status-infos-header">
      <img src=${serverData.icon || "./assets/img/default/server-default-image.webp"} alt="server image" />
      <h1>${serverIp}</h1>
    </div>
    <div class="server-status-infos-body">
      <div class="server-status-infos-motd">
        <h2>MOTD :</h2>
        <div class="server-status-infos-motd-view">
        ${serverData.motd.html.map(i => i)}
        </div>
      </div>
      <div class="server-status-infos-players">
        <h2>players :</h2>
        <span>${serverData.players?.online || 0} / ${serverData.players?.max || 0}</span>
      </div>
      <div class="server-status-infos-version">
      <h2>Version :</h2>
      <span>${serverData.version || "Aucune"}</span>
      </div>
      <div class="server-status-infos-online">
      <h2>Status :</h2>
      <span>${serverData.online ? "En Ligne" :  "Hors Ligne"}</span>
      </div>
    </div>
  `;
    } catch (error) {
      console.log(error)
    }
  });
