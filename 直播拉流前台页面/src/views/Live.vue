<template>
  <div class="h-100 page" style="min-width:1080px;">
    <!-- 导航栏 -->
    <Header v-if="!modal2Visible && !modalVisible" />
    <div
      style="padding: 10px 80px 0;"
      class="page"
      v-if="!modal2Visible && !modalVisible"
    >
      <!-- 直播顶部 -->
      <a-row type="flex" justify="space-between">
        <span style="margin-left:10px;">
          <span
            style="height:20px;line-height:20px;font-size:30px;color:whitesmoke"
            >{{ room_info.title }}</span
          ></span
        >
      </a-row>
      <a-row type="flex" justify="space-between">
        <a-col style="color:white;margin-top:20px;">
          <template v-if="room_info.state == 1">
            <a-icon type="caret-right" style="margin-right:8px;" /><span
              style="height:20px;line-height:20px;font-size:14px;"
              >直播中</span
            >
          </template>
          <template v-if="room_info.state == 0">
            <a-icon type="pause" style="margin-right:8px;" />
            <span style="height:20px;line-height:20px;font-size:14px;"
              >当前主播不在线...</span
            >
          </template>
          <template v-if="room_info.state == 2">
            <a-icon type="pause" style="margin-right:8px;" />
            <span style="height:20px;line-height:20px;font-size:14px;"
              >回放中</span
            >
          </template>

          <span style="margin-left:50px;">
            <a-icon type="clock-circle" style="margin-right:8px;" />
            <span style="height:20px;line-height:20px;font-size:14px;">{{
              room_info.update_time | timeFilter
            }}</span></span
          >
          <a-tooltip
            style="cursor:default;"
            placement="right"
            title="人气值"
            :get-popup-container="getPopupContainer"
          >
            <span style="margin-left:50px;">
              <a-icon type="team" style="margin-right:8px;" />
              <span style="height:20px;line-height:20px;font-size:14px;">{{
                room_info.count
              }}</span></span
            >
          </a-tooltip>
        </a-col>
      </a-row>
      <!-- 直播中间 -->

      <a-row
        type="flex"
        justify="center"
        class="live-container"
        style="margin-top:20px;max-height: 920px;min-width:1000px;"
      >
        <a-col :span="17" class="h-100" style="margin:10px;">
          <div style="position:relative;flex:1" class="h-100">
            <video-player
              class="video-player vjs-custom-skin h-100"
              ref="videoPlayer"
              :playsinline="true"
              :options="playerOptions"
              @play="onPlayerPlay($event)"
              @pause="onPlayerPause($event)"
              @ended="onPlayerEnded($event)"
              @volumechange="onVolumechange($event)"
            ></video-player>

            <div
              onselectstart="return false;"
              style="line-height:80px;text-align:center;cursor:default;-moz-user-select: none;position:absolute;top:10%;right:20%;opacity: 0.9;width:160px;height:80px;font-size:30px;color:white"
            >
              {{
                $store.state.loginInfo.username
                  ? $store.state.loginInfo.username
                  : "游客"
              }}
            </div>

            <div
              onselectstart="return false;"
              style="line-height:80px;text-align:center;cursor:default;-moz-user-select: none;position:absolute;top:10%;left:20%;opacity: 0.9;width:160px;height:80px;font-size:30px;color:white"
            >
              {{
                $store.state.loginInfo.username
                  ? $store.state.loginInfo.username
                  : "游客"
              }}
            </div>

            <div
              onselectstart="return false;"
              style="line-height:80px;text-align:center;cursor:default;-moz-user-select: none;position:absolute;bottom:22%;right:20%;opacity: 0.9;width:160px;height:80px;font-size:30px;color:white"
            >
              {{
                $store.state.loginInfo.username
                  ? $store.state.loginInfo.username
                  : "游客"
              }}
            </div>

            <div
              onselectstart="return false;"
              style="line-height:80px;text-align:center;cursor:default;-moz-user-select: none;position:absolute;bottom:22%;left:20%;opacity: 0.9;width:160px;height:80px;font-size:30px;color:white"
            >
              {{
                $store.state.loginInfo.username
                  ? $store.state.loginInfo.username
                  : "游客"
              }}
            </div>
            <div
              onselectstart="return false;"
              style="line-height:80px;text-align:center;cursor:default;-moz-user-select: none;position:absolute;bottom:50%;left:50%; transform: translate(-50%, -50%);opacity: 0.9;width:160px;height:80px;font-size:30px;color:white"
            >
              {{
                $store.state.loginInfo.username
                  ? $store.state.loginInfo.username
                  : "游客"
              }}
            </div>
          </div>
        </a-col>
        <a-col
          :span="6"
          style="text-align:left;display:flex;flex-direction:column;"
          class="h-100 bg-message"
        >
          <div
            style="flex:auto;overflow-y:auto;"
            @scroll="onScroll"
            class="chat-content"
          >
            <template v-for="(item, index) in messageList">
              <chatMessage :obj="item" :key="index" />
            </template>
          </div>
          <div
            style="display:flex;width:100%;border-radius: 8px;text-align: left;padding:2px;justify-content:center;align-items:center"
            class="border "
          >
            <a-textarea
              :placeholder="
                $store.state.loginInfo.token
                  ? '输入需要发送的内容'
                  : '登录后才可发言'
              "
              style="width:70%;height:40px;resize: none;overflow:hidden"
              :rows="2"
              v-model="msg"
              :disabled="!$store.state.loginInfo.token"
            />

            <a-button
              @click="sendMsg"
              :disabled="!$store.state.loginInfo.token"
              type="primary"
              size="large"
              style="margin-left:4px;height:35px;"
            >
              {{ $store.state.loginInfo.token ? "发送消息" : "请登录" }}
            </a-button>
          </div>
        </a-col>
      </a-row>
      <a-row style="padding:0 30px;">
        <a-col style="text-align:left;">
          <a-tabs
            default-active-key="1"
            style="color:whitesmoke;padding:3px;"
            size="large"
          >
            <a-tab-pane
              key="1"
              tab="介绍"
              style="color:whitesmoke;border:0!important"
              class="ql-container ql-snow"
            >
              <div class="ql-editor" v-html="room_info.desc"></div>
            </a-tab-pane>
          </a-tabs>
        </a-col>
      </a-row>
    </div>

    <a-modal
      :closable="false"
      :visible="modal2Visible"
      title="选择直播间"
      :maskClosable="false"
      :keyboard="false"
      centered
      :footer="null"
    >
      <a-row type="flex" justify="start" align="middle">
        <a-button type="primary" style="" @click="openLive(1)">
          中文直播间
        </a-button>
        <a-button type="primary" style="margin-left:20px;" @click="openLive(2)">
          英文直播间
        </a-button>
      </a-row>
    </a-modal>

    <a-modal
      :closable="false"
      :visible="modalVisible"
      title="请登录"
      :maskClosable="false"
      :keyboard="false"
      centered
      :footer="null"
    >
      <a-row type="flex" justify="start" align="middle">
        <a-button type="primary" style="" @click="toLogin">
          登录
        </a-button>
      </a-row>
    </a-modal>
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
  created() {},
  destroyed() {
    this.websock.close(); //离开路由之后断开websocket连接
  },
  methods: {
    toLogin() {
      this.$router.push("/login");
    },
    onVolumechange(event) {
      console.log(event);
      if (document.querySelector(".vjs-tech").muted) {
        console.log("muted");
        document.querySelector(
          ".vjs-mute-control .vjs-icon-placeholder"
        ).className = "vjs-icon-placeholder muted-icon";
      } else {
        document.querySelector(
          ".vjs-mute-control .vjs-icon-placeholder"
        ).className = "vjs-icon-placeholder";
      }

      document.querySelector(".vjs-mute-control").onclick = () => {
        if (document.querySelector(".vjs-tech").muted) {
          document.querySelector(
            ".vjs-mute-control .vjs-icon-placeholder"
          ).className = "vjs-icon-placeholder muted-icon";
        } else {
          document.querySelector(
            ".vjs-mute-control .vjs-icon-placeholder"
          ).className = "vjs-icon-placeholder";
        }
      };
    },
    getPopupContainer(trigger) {
      return trigger.parentElement;
    },
    openLive(id) {
      location.href = location.origin + "/" + location.hash + "?id=" + id;

      location.reload();
    },
    onPlayerPlay() {
      document.querySelector(".vjs-big-play-button").hidden = true;
      document.querySelector(
        ".video-js .vjs-play-control .vjs-icon-placeholder"
      ).className = "vjs-icon-placeholder play-icon";
    },
    onPlayerPause() {
      console.log("pause");
      document.querySelector(".vjs-big-play-button").hidden = false;
      document.querySelector(
        ".video-js .vjs-play-control .vjs-icon-placeholder"
      ).className = "vjs-icon-placeholder pause-icon";
    },
    onPlayerEnded() {
      document.querySelector(".vjs-big-play-button").hidden = false;
    },

    initWebSocket() {
      //初始化weosocket
      console.log("init");
      const wsuri = "ws://118.190.174.221:8282";
      this.websock = new WebSocket(wsuri);
      this.websock.onmessage = this.websocketonmessage;
      this.websock.onopen = this.websocketonopen;
      this.websock.onerror = this.websocketonerror;
      this.websock.onclose = this.websocketclose;
    },
    websocketonopen() {
      //连接建立之后执行send方法发送数据

      let actions = {
        type: "enter",
        room_id: this.$route.query.id,
        token: this.$store.state.loginInfo["token"],
      };
      setInterval(() => {
        this.websocketsend(
          JSON.stringify({
            type: "heartbeat",
          })
        );
      }, 60000);
      this.websocketsend(JSON.stringify(actions));
    },
    websocketonerror() {
      //连接建立失败重连
      this.initWebSocket();
    },
    websocketonmessage(e) {
      //数据接收
      const redata = JSON.parse(e.data);

      if (redata.code == 1) {
        var msg = redata.msg;
        var data = redata.data;
        switch (msg) {
          case "msg":
            this.pushMsg(data);
            break;
          case "room_info":
            this.updateRoom(data);
            break;
          default:
            break;
        }
      }
    },
    updateRoom(data) {
      this.$set(this.room_info, "title", data.title);
      this.$set(this.room_info, "status", data.status);
      this.$set(this.room_info, "state", data.state);
      this.$set(this.room_info, "update_time", data.update_time);
      this.$set(this.room_info, "count", parseInt(data.count));
      this.$set(this.room_info, "desc", data.desc);
      this.modalVisible = false;
      if (data.status) {
        //
        if (!this.$store.state.loginInfo.token) {
          this.modalVisible = true;
        }
      }

      if (document.querySelector(".vjs-tech").muted) {
        console.log("muted");
        document.querySelector(
          ".vjs-mute-control .vjs-icon-placeholder"
        ).className = "vjs-icon-placeholder muted-icon";
      } else {
        document.querySelector(
          ".vjs-mute-control .vjs-icon-placeholder"
        ).className = "vjs-icon-placeholder";
      }

      document.querySelector(".vjs-mute-control").onclick = () => {
        if (document.querySelector(".vjs-tech").muted) {
          document.querySelector(
            ".vjs-mute-control .vjs-icon-placeholder"
          ).className = "vjs-icon-placeholder muted-icon";
        } else {
          document.querySelector(
            ".vjs-mute-control .vjs-icon-placeholder"
          ).className = "vjs-icon-placeholder";
        }
      };
      if (data.url == this.playerOptions.sources.src) {
        return;
      }
      this.playerOptions.sources.src = data.url;
      let myPlayer = this.$refs.videoPlayer.player;
      myPlayer.src(data.url);
      myPlayer.play();
    },
    sendMsg() {
      if (!this.$store.state.loginInfo.token) {
        return;
      }
      if (this.msg == "") {
        return this.$message.error("请输入内容");
      }
      var msg = this.msg;
      let obj = {
        type: "send",
        room_id: this.$route.query.id,
        content: msg,
        token: this.$store.state.loginInfo.token,
      };
      this.websock.send(JSON.stringify(obj));
      this.msg = "";
      //
    },
    pushMsg(data) {
      data.forEach((item) => {
        //console.log(item);
        let obj = {
          createTime: new Date().getTime(),
          username: item.username,
          content: item.content,
          id: this.$route.query.id,
        };
        this.messageList.push(obj);
      });

      if (this.canScroll) {
        var message = document.querySelector(".chat-content");
        message.scrollTop = message.scrollHeight;
      }
    },
    websocketsend(Data) {
      //数据发送
      this.websock.send(Data);
    },
    websocketclose(e) {
      //关闭
      console.log("断开连接", e);
    },
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
        } else {
        }
      }
      this.scrollTop = top;
    },
  },
  filters: {
    timeFilter(time) {
      return new Date(time * 1000).Format("yyyy-MM-dd hh:mm:ss");
    },
  },
  data() {
    return {
      room_info: {},
      modalVisible: false,

      modal2Visible: false,
      msg: "",
      websock: null,
      canScroll: true,
      scrollTop: 0,
      messageList: [],
      playerOptions: {
        playbackRates: [0.7, 1.0, 1.5, 2.0], //播放速度
        autoplay: false, //如果true,浏览器准备好时开始回放。
        muted: true, // 默认情况下将会消除任何音频。
        loop: false, // 导致视频一结束就重新开始。
        preload: "auto", // 建议浏览器在<video>加载元素后是否应该开始下载视频数据。auto浏览器选择最佳行为,立即开始加载视频（如果浏览器支持）
        language: "zh-CN",
        aspectRatio: "16:9", // 将播放器置于流畅模式，并在计算播放器的动态大小时使用该值。值应该代表一个比例 - 用冒号分隔的两个数字（例如"16:9"或"4:3"）
        // fluid: true, // 当true时，Video.js player将拥有流体大小。换句话说，它将按比例缩放以适应其容器。
        sources: [
          {
            type: "application/x-mpegURL", //这里的种类支持很多种：基本视频格式、直播、流媒体等，具体可以参看git网址项目
            src: "", //url地址
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
    //document.querySelector(".vjs-tech").play();

    if (this.$route.query.id) {
      let r_id = parseInt(this.$route.query.id);
      if (r_id != 1 && r_id != 2) {
        //非法连接 选择直播间
        console.log("非法");
        this.modal2Visible = true;
      } else {
        console.log("不非法");
        this.modal2Visible = false;
        this.initWebSocket();
      }
    } else {
      this.modal2Visible = true;
    }
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

<style lang="less">
//主背景色
@mainbgc: #27282e;
//顶部导航栏背景
@mainheaderbg: #2f3035;
.page {
  background-color: @mainbgc;
}
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
.play-icon:before {
  content: "\f103" !important;
}
.pause-icon:before {
  content: "\f101" !important;
}

.muted-icon:before {
  content: "\f105" !important;
}

/*定义滑块 内阴影+圆角*/
::-webkit-scrollbar-thumb {
  border-radius: 10px;
  box-shadow: inset 0 0 0px rgba(240, 240, 240, 0.5);
  background-color: #aaa;
}
</style>
