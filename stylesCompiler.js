const sass = require("sass");
const fs = require("fs");

const compiler = async () => {
  try {
    const result = await sass.compileAsync("./assets/styles/styles.scss");
    fs.writeFile("./assets/styles/styles.css", result.css, (err) => {
      if (err) throw err;
      console.log("CSS compiler avec succès");
    });
  } catch (error) {
    console.log("css compiler", error.message);
  }
};

compiler();