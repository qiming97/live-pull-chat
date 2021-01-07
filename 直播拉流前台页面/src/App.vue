<template>
  <div id="app" class="h-100">
    <router-view class="h-100 w-100" />
  </div>
</template>

<script>
export default {
  created() {
    //在页面加载时读取sessionStorage里的状态信息

    if (localStorage.getItem("zxcv")) {
      this.$store.replaceState(
        Object.assign(
          {},
          this.$store.state,
          JSON.parse(atob(localStorage.getItem("zxcv")))
        )
      );
    }

    //在页面刷新之前将vuex里的信息保存到sessionStorage里
    window.addEventListener("beforeunload", () => {
      localStorage.setItem("zxcv", btoa(JSON.stringify(this.$store.state)));
    });
  },
  components: {},
};
</script>

<style lang="less">
//主背景色
@mainbgc: #27282e;
//顶部导航栏背景
@mainheaderbg: #2f3035;

.header {
  min-width: 666px;
  padding: 0 auto !important;
  margin: 0 auto !important;
  background-color: @mainheaderbg;
  line-height: 66px;
  height: 66px;
  color: whitesmoke;
  width: 100%;
  .header-container {
    width: 90%;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
}

@media screen and (min-width: 1920px) {
  .live-container {
    height: 800px;
    min-height: 800px;
  }
}
/* css注释：设置了浏览器宽度不小于1201px时 abc 显示1200px宽度 */

.slick-initialized {
  height: 100%;
}
.slick-dots li button {
  height: 7px !important;
}
.pointer {
  cursor: pointer;
}
.ant-carousel svg {
  font-size: 24px;
}
.slick-list {
  height: 100%;
}
.slick-track {
  height: 100%;
}
.slick-slide {
  height: 100% !important;
}
.slick-slide div {
  height: 100% !important;
}
@media screen and (max-width: 1921px) {
  .live-container {
    height: 700px;
    min-height: 700px;
  }
}

@media screen and (max-width: 1600px) {
  .live-container {
    height: 600px;
    min-height: 600px;
  }
}

.ant-tabs-content {
  height: 100% !important;
}
#vjs_video_3 {
  position: relative;
}

.vjs_video_3-dimensions.vjs-fluid {
  padding-top: 10px;
}
svg {
  font-size: 14px;
}
.bg-header {
  background-color: @mainheaderbg!important;
}
.bg-message {
  background-color: @mainheaderbg!important;
}
.bg-message-footer {
  background-color: #383a42;
}
.bg-main {
  background-color: @mainbgc!important;
}
#app {
  width: 100%;

  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#components-layout-demo-basic .ant-layout-footer {
  background-color: @mainbgc;
}

#components-layout-demo-basic .ant-layout-header {
  background-color: @mainbgc;
  color: whitesmoke;
}
#components-layout-demo-basic {
  text-align: left;
  min-width: 1288px;
  background-color: @mainbgc!important;
}

* {
  font-family: Verdana, Geneva, sans-serif;
  font-size: 13px;
  background-color: transparent;
}

.video-js .vjs-big-play-button {
  font-size: 3em;
  line-height: 1.5em;
  height: 1.5em;
  width: 3em;
  display: block;
  position: absolute;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%) !important;
  padding: 0;
  cursor: pointer;
  opacity: 0.7 !important;
  border: 0.06666em solid #fff;

  background-color: rgba(43, 51, 63, 0.7);
  border-radius: 0.3em;
  transition: all 0.4s;
}

.bg-white {
  background-color: white !important;
}
.border-top {
  border-top: 1px solid#e4e4e4;
}
.border-y {
  border-top: 1px solid#e4e4e4;
  border-bottom: 1px solid#e4e4e4;
}
.border-x {
  border-left: 1px solid#e4e4e4;
  border-right: 1px solid#e4e4e4;
}
.border {
  border: 1px solid @mainbgc;
}

.border-left {
  border-left: 1px solid#e4e4e4;
}
.border-right {
  border-right: 1px solid#e4e4e4;
}
.border-bottom {
  border-bottom: 1px solid#e4e4e4;
}
.h-100 {
  height: 100%;
}
.w-100 {
  width: 100%;
}
.video-js.vjs-fluid,
.video-js.vjs-16-9,
.video-js.vjs-4-3 {
  height: 100% !important;
}
.video-js {
  height: 100% !important;
}
.vjs-controls-enabled {
  height: 100% !important;
}

.video-js.vjs-fluid {
  height: 100% !important;
}
.w-90 {
  width: 90%;
}
.h-90 {
  height: 90%;
}
.h-95 {
  height: 95%;
}
.h-5 {
  height: 5%;
}
.video-player {
  height: 95%;
}
.vjs-live {
  height: 100% !important;
}
</style>
