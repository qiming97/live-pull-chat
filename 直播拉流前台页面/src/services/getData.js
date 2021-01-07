import { get, post } from "./ajax";

//获取配置
export function getConfig() {
  return get("static/config.json", null, { baseURL: "./" });
}

// 登陆
export function Login(params) {
  return post("/user/login", params);
}

// 注册
export function Register(params) {
  return post("/user/create", params);
}

// 获取轮播图
export function bannerList(params) {
  return get("/index/index", params);
}
