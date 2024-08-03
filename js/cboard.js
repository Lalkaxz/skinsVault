async function copyUrl(url) {
    try {
        await navigator.clipboard.writeText(url);
      } catch (error) {
        console.error(error.message);
      }
    }


function downUrl(url, name) {
  fetch(url)
    .then((res) => {
        if (!res.ok) {
            throw new Error("Network Problem");
        }
        return res.blob();
    })
    .then((file) => {
        const ex = extFn(url);
        let tUrl = URL.createObjectURL(file);
        const tmp1 = document.createElement("a");
        tmp1.href = tUrl;
        tmp1.download = `${name}_skin.${ex}`;
        document.body.appendChild(tmp1);
        tmp1.click();
        URL.revokeObjectURL(tUrl);
        tmp1.remove();
    })
    .catch((er) => {
      console.log(`error: ${er}`);
    });
}

function extFn(url) {
const match = url.match(/\.[0-9a-z]+$/i);
return match ? match[0].slice(1) : "";
}
