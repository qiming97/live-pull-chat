import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import md5 from "js-md5";
Vue.prototype.$md5 = md5;
// import 'bootstrap/dist/css/bootstrap.min.css'

// import $ from 'jquery'

// import 'bootstrap/dist/js/bootstrap.bundle'

// import 'bootstrap/dist/js/bootstrap.min.js'

import "ant-design-vue/dist/antd.css";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import {
  Button,
  Tag,
  Input,
  Affix,
  Tabs,
  Icon,
  Row,
  Col,
  Carousel,
  Divider,
  Form,
  Checkbox,
  message,
  Modal,
  Tooltip,
} from "ant-design-vue";

import VideoPlayer from "vue-video-player";
import "video.js/dist/video-js.css"; //videoJs的样式
// import 'vue-video-player/src/custom-theme.css' //vue-video-player的样式
//import 'videojs-flash'; //引入才能播放rtmp视屏
import "videojs-contrib-hls"; //引入才能播放m3u8文件
Vue.use(VideoPlayer);
Vue.prototype.$message = message;
Vue.use(message);
Vue.component(Tooltip.name, Tooltip);
Vue.component(Modal.name, Modal);
Vue.component(Button.name, Button);
Vue.component(Tag.name, Tag);
Vue.component(Row.name, Row);
Vue.component(Col.name, Col);
Vue.component(Input.name, Input);
Vue.component(Input.TextArea.name, Input.TextArea);
Vue.component(Affix.name, Affix);
Vue.component(Tabs.name, Tabs);

Vue.component(Icon.name, Icon);
Vue.component(Tabs.TabPane.name, Tabs.TabPane);
Vue.component(Carousel.name, Carousel);
Vue.component(Divider.name, Divider);

Vue.component(Form.name, Form);
Vue.component(Form.Item.name, Form.Item);
Vue.component(Checkbox.name, Checkbox);

Vue.config.productionTip = false;

router.beforeEach((to, from, next) => {
  /* 路由发生变化修改页面title */
  if (to.meta.title) {
    document.title = to.meta.title;
  }
  next();
});

new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");

Date.prototype.Format = function(fmt) {
  // author: meizz
  var o = {
    "M+": this.getMonth() + 1, // 月份
    "d+": this.getDate(), // 日
    "h+": this.getHours(), // 小时
    "m+": this.getMinutes(), // 分
    "s+": this.getSeconds(), // 秒
    "q+": Math.floor((this.getMonth() + 3) / 3), // 季度
    S: this.getMilliseconds(), // 毫秒
  };
  if (/(y+)/.test(fmt))
    fmt = fmt.replace(
      RegExp.$1,
      (this.getFullYear() + "").substr(4 - RegExp.$1.length)
    );
  for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt))
      fmt = fmt.replace(
        RegExp.$1,
        RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length)
      );
  return fmt;
};
