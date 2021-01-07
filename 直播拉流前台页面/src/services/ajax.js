const baseUrl = location.origin + "/back/public/index.php/api";

const request = (url, config) => {
  return fetch(baseUrl + url, config)
    .then((res) => {
      if (res.ok) {
        const json = res.json();

        return json;
      } else {
        // 服务器异常

        throw Error("");
      }
    })
    .catch((error) => {
      console.log(error);
    });
};

export const get = (url) => {
  return request(url, { method: "GET" });
};

export const post = (url, config) => {
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");
  return request(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(config),
    redirect: "follow",
  });
};
