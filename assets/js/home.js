const randomElement = (array) => {
    const randomIndex = Math.floor(Math.random() * array.length);
  
    return array[randomIndex];
  };
  
  const getServerData = async (serverIp) => {
    return new Promise(async (resolve, reject) => {
      try {
        const response = await fetch(`https://api.mcsrvstat.us/3/${serverIp}`);
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
  
  const setRandomServerHomePage = () => {
    fetch(`http://localhost/mcweblist/?action=get-server`).then(async (res) => {
      const data = await res.json();
      
      const randomElementData = randomElement(data);
  
      const serverData = await getServerData(randomElementData.server_ip);
      console.log(data)
      document.querySelector(".home-section-container").innerHTML = `
      <div class="random-server-container">
          <div class="random-server-header">
          <img src="${
            serverData.icon || "./assets/img/default/server-default-image.webp"
          }" alt="server image" />
        <h1>${randomElementData.name}</h1>
          </div>
          <div class="random-server-body">
          <div class="random-server-body-ip">
          <h2>${serverData.hostname}</h2>
          </div>
            <div class="random-server-body-player">
              <h2>PLAYERS</h2>
              <span>${serverData.players ? serverData.players?.online || 0 : 0} / ${serverData.players ? serverData.players?.max || 0 : 0}</span>
            </div>
          </div>
      </div>`;
    });
  };
  
  setRandomServerHomePage();


  