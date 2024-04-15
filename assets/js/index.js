document.addEventListener("DOMContentLoaded", async function () {
  const burgerButton = document.querySelector(".hamburger");
  const openNav = document.querySelector(".navigation");

  burgerButton.addEventListener("click", function () {
    openNav.classList.toggle("open");
  });

  const oneServerData = () => {
    return new Promise(async (resolve, reject) => {
      try {

        const urlParamsServerId = new URLSearchParams(this.location.href).get('serverId')
        
        const response = await fetch(
          `http://localhost/mcweblist/?action=get-server-infos&serverId=${urlParamsServerId}`
        );
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        const serverData = await response.json();
        resolve(JSON.parse(serverData.servers));
      } catch (error) {
        reject(error);
      }
    });
  };

  const getServerDataSearch = async (isBedrock, serverIp) => {
    return new Promise(async (resolve, reject) => {
      const isBedrockNow = isBedrock ? "/bedrock/3/" : "/3/";
      try {
        const response = await fetch(
          `https://api.mcsrvstat.us${isBedrockNow}${serverIp}`
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

  const serverOnePage = document.querySelector(".server-one-infos-section");

  if (serverOnePage) {
    const initialServerData = await oneServerData();
    const onlineServerData = await getServerDataSearch(
      false,
      initialServerData.ip
    );
    
    const firstServerOneData = document.querySelector('.server-one-infos-first')
    const firstServerOneDataDescription = document.querySelector(".server-one-infos-two-description")
    const messageServerDataList = document.querySelector('.server-one-infos-two-all-comment')
    if(firstServerOneData){
      firstServerOneData.innerHTML = `    
      <img  alt="Server Icon" src="${onlineServerData.icon ? onlineServerData.icon : "./assets/img/default/server-default-image.webp"}" />
      <div class="server-one-infos-first-name">
          <h2>${initialServerData.name}</h2>
      </div>
  
      <div class="server-one-infos-first-ip">
          <h2>IP :</h2>
          <span>${initialServerData.ip}</span>
      </div>
  
      <div class="server-one-infos-first-players">
          <h2>Joueurs :</h2>
          <span>${onlineServerData.players ? onlineServerData.players?.online : 0} / ${onlineServerData.players ? onlineServerData?.players.max : 20}</span>
      </div>
  
      <div class="server-one-infos-first-status">
          <h2>Status :</h2>
          <span>${onlineServerData.online ? "En Ligne" : "Hors Ligne"}</span>
      </div>`;
   


      firstServerOneDataDescription.innerHTML = `
        <h2>Description :</h2>
        <span>${initialServerData.description}</span>
      `

      console.log(initialServerData)
      if(initialServerData.messages[0].content){
        messageServerDataList.innerHTML = initialServerData.messages.map(i => `
        <div class="comment-container">
                        <h1>${i.author.author}</h1>
                        <span>
                            ${i.content}
                        </span>
                        ${isAdmin ? `<a class="button-delete-message" href="?action=delete-message&messageId=${i.id}&serverId=${i.serverId}">DELETE</a>` : ''}
                    </div>`)
      }
    }  
  }
});
