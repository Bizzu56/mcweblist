const getAllServerList = (isPrivate) => {
  const url = `http://localhost/mcweblist/?action=${
    isPrivate ? "get-myserver" : "get-server"
  }`;
  return new Promise((resolve, reject) => {
    fetch(url)
      .then(async (res) => {
        const json = await res.json();
        resolve(json);
      })
      .catch((error) => {
        reject(error);
      });
  });
};

const getServerOnlineData = async (serverIp) => {
  try {
    const response = await fetch(`https://api.mcsrvstat.us/3/${serverIp}`);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const data = await response.json();
    return data;
  } catch (error) {
    throw error;
  }
};

const setCard = (
  icon,
  name,
  ip,
  maxPlayer,
  minPlayer,
  serverId,
  showDeleteButton
) => {
  return `
<div class="server-card">
<div class="server-card-header">
    <img src="${
      icon ? `${icon}` : "./assets/img/default/server-default-image.webp"
    }"/>
</div>
<div class="server-card-body">
    <div class="server-card-body-data">
        <h1>${name}</h1>
        <h2>${ip}</h2>
        <div class="server-card-players">
            <h2>Players online :</h2>
            <span>${minPlayer} / ${maxPlayer}</span>
        </div>
    </div>
    <div class="server-card-body-view">
        <a href="?action=server-infos&serverId=${serverId}">VOIR LE SERVEUR</a>
        ${
          showDeleteButton
            ? `<a href="?action=delete-server&serverId=${serverId}">SUPPRIMER</a>`
            : ""
        }
    </div>
</div>
</div>
    `;
};

const setAllServerList = async () => {
  const server_public_list = document.querySelector(".server-list-container");
  const server_private_list = document.querySelector(
    ".server-private-list-container"
  );
  const server_admin_list = document.querySelector(
    ".server-admin-list-container"
  );
  if (server_public_list) {
    try {
      const serverListData = await getAllServerList(false);
      console.log(serverListData);
      if (serverListData.length) {
        const promises = serverListData.map(async (element) => {
          const serverOnlineData = await getServerOnlineData(element.server_ip);
          const showDeleteButton =
            window.location.href.includes("action=myserver");
          return setCard(
            serverOnlineData.icon,
            element.name,
            element.server_ip,
            serverOnlineData.players ? serverOnlineData.players.max : 20,
            serverOnlineData.players ? serverOnlineData.players.online : 0,
            element.id,
            showDeleteButton
          );
        });
        const cardsHtml = await Promise.all(promises);
        console.log(cardsHtml);
        server_public_list.innerHTML = cardsHtml.join("");
      }
    } catch (error) {
      console.error(error);
    }
  } else if (server_private_list) {
    try {
      const serverListData = await getAllServerList(true);
      if (serverListData.length) {
        const promises = serverListData.map(async (element) => {
          const serverOnlineData = await getServerOnlineData(element.server_ip);
          const showDeleteButton =
            window.location.href.includes("action=myserver");
          return setCard(
            serverOnlineData.icon,
            element.name,
            element.server_ip,
            serverOnlineData.players ? serverOnlineData.players.max : 20,
            serverOnlineData.players ? serverOnlineData.players.online : 0,
            element.id,
            showDeleteButton
          );
        });
        const cardsHtml = await Promise.all(promises);
        server_private_list.innerHTML = cardsHtml.join("");
      }
    } catch (error) {
      console.error(error);
    }
  } else if (server_admin_list) {
    try {
      const serverListData = await getAllServerList(false);
      if (serverListData.length) {
        const promises = serverListData.map(async (element) => {
          const serverOnlineData = await getServerOnlineData(element.server_ip);
          const showDeleteButton = window.location.href.includes(
            "action=admin-server"
          );
          return setCard(
            serverOnlineData.icon,
            element.name,
            element.server_ip,
            serverOnlineData.players ? serverOnlineData.players.max : 20,
            serverOnlineData.players ? serverOnlineData.players.online : 0,
            element.id,
            showDeleteButton
          );
        });
        const cardsHtml = await Promise.all(promises);
        server_admin_list.innerHTML = cardsHtml.join("");
      }
    } catch (error) {
      console.error(error);
    }
  }
};

setAllServerList();
