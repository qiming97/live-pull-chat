<template>
  <div id="components-layout-demo-basic" class="h-100">
    <Header />
    <template v-if="false">
      <a-icon type="caret-right" style="margin-right:8px;" /><span
        style="height:20px;line-height:20px;font-size:14px;"
        >直播中</span
      >
    </template>
    <template v-else>
      <a-icon type="pause" style="margin-right:8px;" />
      <span style="height:20px;line-height:20px;font-size:14px;"
        >当前主播不在线...</span
      >

      <span style="margin-left:50px;">
        <a-icon type="clock-circle" style="margin-right:8px;" />
        <span style="height:20px;line-height:20px;font-size:14px;"
          >2020-12-09 20:55</span
        ></span
      >
      <span style="margin-left:50px;">
        <a-icon type="team" style="margin-right:8px;" />
        <span style="height:20px;line-height:20px;font-size:14px;"
          >6556人气</span
        ></span
      >
    </template>

    <div style="position:relative;flex:1">
      <video-player
        class="video-player vjs-custom-skin h-100"
        ref="videoPlayer"
        :playsinline="true"
        :options="playerOptions"
        @play="onPlayerPlay($event)"
        @pause="onPlayerPause($event)"
        @ended="onPlayerEnded($event)"
      ></video-player>
      <div class="bg-header" style="height:50px;"></div>

      <div
        onselectstart="return false;"
        style="line-height:80px;text-align:center;cursor:default;-moz-user-select: none;position:absolute;top:20px;right:15px;opacity: 0.9;width:160px;height:80px;font-size:20px;color:white"
      >
        千人千面
      </div>
    </div>
    <a-layout
      class="h-100 w-90 bg-main"
      style="margin:0 auto;padding:0 auto;min-width:1080px;"
    >
      <a-layout-header> </a-layout-header>
      <a-layout>
        <a-layout-content
          style="padding:10px;display:flex;flex-direction:column"
          class="bg-main "
        >
        </a-layout-content>

        <!-- 聊天框 -->
        <a-layout-sider
          class="bg-message border h-100"
          style="min-width: 350px;padding: 5px;"
        >
          <a-layout
            class="h-100 bg-message"
            style="display:flex;flex-direction:column"
          >
            <!-- 聊天消息 -->
            <a-layout-content
              style="flex:auto;overflow-y:auto;"
              @scroll="onScroll"
              class="chat-content"
            >
              <template v-for="(item, index) in messageList">
                <chatMessage :obj="item" :key="index" />
              </template>
            </a-layout-content>

            <!-- 输入框 -->
            <a-layout-footer
              style="padding:1px;height:50px;"
              class="bg-message-footer "
            >
              <div
                style="display:flex;width:100%;border-radius: 8px;text-align: left;padding:2px;justify-content:center;align-items:center"
                class="border h-100"
              >
                <a-textarea
                  placeholder="输入需要发送的内容"
                  style="width:70%;height:40px;resize: none;overflow:hidden"
                  :rows="2"
                />

                <a-button
                  type="primary"
                  size="large"
                  style="margin-left:4px;height:35px;"
                >
                  发送消息
                </a-button>
              </div>
            </a-layout-footer>
          </a-layout>
        </a-layout-sider>
      </a-layout>
      <a-layout-footer style="color:whitesmoke">
        <a-tabs default-active-key="1" style="color:whitesmoke" size="large">
          <a-tab-pane key="1" tab="介绍" style="color:whitesmoke">
            <img
              src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=3942751454,1089199356&fm=26&gp=0.jpg"
              alt=""
            />
            <br />
            《毛诗-大序》记载：“诗者，志之所之也。在心为志，发言为诗”。南宋严羽《沧浪诗话》云：“诗者，吟咏性情也”。只有一种用言语表达的艺术就是诗歌。
            <img
              src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=3942751454,1089199356&fm=26&gp=0.jpg"
              alt=""
            />
          </a-tab-pane>
        </a-tabs>
      </a-layout-footer>
    </a-layout>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
var timer;
import chatMessage from "../components/chatMessage";
function getRandomChineseWord() {
  var _rsl = "";
  var _randomUniCode = Math.floor(
    Math.random() * (40870 - 19968) + 19968
  ).toString(16);
  eval("_rsl=" + '"\\u' + _randomUniCode + '"');
  return _rsl;
}
function randomString(e) {
  e = e || 32;
  var t = "ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678",
    a = t.length,
    n = "";
  for (let i = 0; i < e; i++) n += t.charAt(Math.floor(Math.random() * a));
  return n;
}
export default {
  name: "Home",
  components: {
    chatMessage,
    Header,
  },
  methods: {
    onScroll(e) {
      //先取scrollTop
      const target = e.target;
      let top = e.target.scrollTop;
      if (this.scrollTop > top) {
        console.log("上滑");
        this.canScroll = false;
        if (timer) {
          clearTimeout(timer);
        }
        timer = setTimeout(() => {
          this.canScroll = true;
        }, 10000);
      } else {
        if (
          target.scrollHeight > target.clientHeight &&
          target.scrollTop + target.clientHeight === target.scrollHeight
        ) {
          console.log("到达底部");
        } else {
          console.log("下滑");
        }
      }
      this.scrollTop = top;
    },
  },

  data() {
    return {
      canScroll: true,
      scrollTop: 0,
      messageList: [
        {
          username: "duck",
          content: "刚刚战绩多少",
          createTime: 178416416,
        },
        {
          username: "忒忒",
          content: "非静止画面哈哈哈",
          createTime: 178416416,
        },
      ],
      playerOptions: {
        playbackRates: [0.7, 1.0, 1.5, 2.0], //播放速度
        autoplay: true, //如果true,浏览器准备好时开始回放。
        muted: false, // 默认情况下将会消除任何音频。
        loop: false, // 导致视频一结束就重新开始。
        preload: "auto", // 建议浏览器在<video>加载元素后是否应该开始下载视频数据。auto浏览器选择最佳行为,立即开始加载视频（如果浏览器支持）
        language: "zh-CN",
        aspectRatio: "16:9", // 将播放器置于流畅模式，并在计算播放器的动态大小时使用该值。值应该代表一个比例 - 用冒号分隔的两个数字（例如"16:9"或"4:3"）
        // fluid: true, // 当true时，Video.js player将拥有流体大小。换句话说，它将按比例缩放以适应其容器。
        sources: [
          {
            type: "application/x-mpegURL", //这里的种类支持很多种：基本视频格式、直播、流媒体等，具体可以参看git网址项目
            src:
              "https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8", //url地址
          },
        ],
        hls: true, //如果是播放m3u8必须加（需注释掉techOrder,不然会有报错）
        // techOrder: ['flash'], //播放rtmp必须加
        poster: "", //你的封面地址
        notSupportedMessage: "此视频暂无法播放，请稍后再试", //允许覆盖Video.js无法播放媒体源时显示的默认信息。
        controlBar: {
          timeDivider: true,
          durationDisplay: true,
          remainingTimeDisplay: false,
          fullscreenToggle: true, //全屏按钮
        },
      },
    };
  },
  mounted() {
    document.querySelector(".vjs-tech").play();
    setInterval(() => {
      var obj = {
        username:
          getRandomChineseWord() +
          getRandomChineseWord() +
          getRandomChineseWord(),
        content: randomString(10),
        createTime: new Date().getTime(),
      };

      // this.messageList.push(obj);
      console.log(this.canScroll);
      if (this.canScroll) {
        var message = document.querySelector(".chat-content");
        message.scrollTop = message.scrollHeight;
      }
    }, 1000);
  },
  watch: {
    messageList(val) {
      const COUNT = 500;
      if (val.length > COUNT) {
        this.messageList = val.splice(-COUNT, COUNT);
      }
    },
  },
};
</script>

<style scoped>
/* 定义滚动条样式 */
::-webkit-scrollbar {
  width: 10px;
  height: 1px;
  background-color: white;
}

/*定义滚动条轨道 内阴影+圆角*/
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 0px rgba(240, 240, 240, 0.5);
  border-radius: 10px;
  background-color: rgba(240, 240, 240, 0.5);
}

/*定义滑块 内阴影+圆角*/
::-webkit-scrollbar-thumb {
  border-radius: 10px;
  box-shadow: inset 0 0 0px rgba(240, 240, 240, 0.5);
  background-color: #aaa;
}
#components-layout-demo-basic .ant-layout-footer {
  line-height: 1.5;
}

#components-layout-demo-basic .ant-layout-content {
  min-height: 120px;
}
#components-layout-demo-basic > .ant-layout {
  margin-bottom: 48px;
}
#components-layout-demo-basic > .ant-layout:last-child {
  margin: 0;
}
</style>
