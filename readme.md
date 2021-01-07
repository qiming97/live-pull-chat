###项目名称 直播拉流+聊天室+直播详情图(图文描述)+直播状态



# 项目技术栈

## 前端

### vue + fetch + wss通讯 + vue-router + vuex+vue-quill-editor

###UI方面使用 antdesign



## 后端

## thinkphp + workman + redis(缓存token及高并发数据)+mysql + jwt鉴权+全局异常处理+中间件校验...



## 快速开始

```
cd 直播拉流前台页面 
npm i
npm run serve

cd 直播拉流后台页面 
npm i
npm run serve

配置环境:
1.导入db_live.sql 到mysql中
2.启动后端里 gatewayworker 服务(务必开启redis服务)
3.将back里的php环境上传到网址目录下并获取入口文件index.php的真实路径,
如 http://localhost/index.php

4.配置back里config文件夹下的database.php
输入正确的数据库名 用户名密码 端口等
5.配置gatewayworker 里 Applications文件夹下的events.php 第40行 设置正确的mysql连接信息

6.配置前端后台页面的的后台统一接口URL：
src/services/ajax.js 下 baseUrl 为 上方获取到的http://localhost/index.php
7.保存 npm run serve
8.开启后端服务
9.即可正常使用


```

