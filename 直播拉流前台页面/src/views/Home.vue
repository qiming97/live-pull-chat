<template>
  <div class="h-100" style="min-width:1220px;">
    <div
      style="height:45%;position:relative;min-width:800px;padding:0 auto;margin:0 auto"
    >
      <!-- 导航栏 -->
      <div
        style="position:absolute;top:2px;left:10px;z-index:999;display:inline-block"
        class="w-100 _header"
      >
        <a class="header-container" @click="location.reload()"> 首页</a>
        <a href="/about" class="header-container" v-if="false"> 关于我们</a>
        <a
          @click="$router.push('/login')"
          class="header-container"
          v-if="!$store.state.loginInfo.token"
        >
          登陆</a
        >
      </div>
      <!-- 轮播图 -->
      <a-carousel autoplay class="w-100 h-100" effect="fade" arrows>
        <div
          slot="prevArrow"
          slot-scope="props"
          class="custom-slick-arrow"
          style="left: 10px;zIndex: 1"
        >
          <a-icon type="left-circle" />
        </div>
        <div
          slot="nextArrow"
          slot-scope="props"
          class="custom-slick-arrow"
          style="right: 10px"
        >
          <a-icon type="right-circle" />
        </div>
        <template v-for="(item, index) in imgList">
          <div class="h-100 w-100" :key="index">
            <a :href="item.url">
              <img :src="item.src" alt="" class="w-100 h-100 pointer" />
            </a>
          </div>
        </template>
      </a-carousel>
    </div>

    <div
      style="height:50%;padding:40px 300px;color:black;min-width:880px;"
      class="w-100 "
    >
      <a-row class="" type="flex" justify="space-between" align="middle">
        <a-col class="h-100" style="text-align:left" :span="12">
          <span style="font-size:35px;font-weight:bold;margin-left:20px;">
            活动现场直播
          </span>
          <br />

          <span
            style="font-size:18px;text-align:left;color:#A9A9A8;font-weight:400;margin-left:20px;"
          >
            提供一站式服务
          </span>

          <!-- 1 -->
          <div
            style="height:150px;width:300px;margin-top:40px;"
            class="bg-card"
          >
            <a-icon type="video-camera" style="color:blue" />
            <span style="margin-left:10px;font-size:18px;font-weight:bold;"
              >高清稳定直播</span
            >
            <br />
            <div style="margin-top:10px;">
              <span
                style="font-size:14px;text-align:left;color:#A9A9A8;font-weight:400;"
              >
                4K高清画质,支持百万用户同时观看,全程保障直播稳定
              </span>
            </div>
          </div>
          <!-- 2 -->
          <div style="height:150px;width:300px;" class="bg-card">
            <a-icon type="heart" style="color:red" />
            <span style="margin-left:10px;font-size:18px;font-weight:bold;"
              >全周期服务</span
            >
            <br />
            <div style="margin-top:10px;">
              <span
                style="font-size:14px;text-align:left;color:#A9A9A8;font-weight:400;"
              >
                前期活动预热、直播中营销互动、后期数据分,打造一场完美活动直播
              </span>
            </div>
          </div>
          <!-- 3 -->
          <div style="height:150px;width:100%" class="bg-card">
            <a-icon type="youtube" style="color:red" />
            <span style="margin-left:10px;font-size:18px;font-weight:bold;"
              >多平台同步直播</span
            >
            <br />
            <div style="margin-top:10px;">
              <span
                style="font-size:14px;text-align:left;color:#A9A9A8;font-weight:400;"
              >
                一键同步至40+主流直播平台,达成最大量直播曝光
              </span>
            </div>
          </div>
        </a-col>
        <a-col :span="12" class="h-100">
          <a-button
            type="primary"
            style="height:50px;width:160px;"
            @click="$router.push('/live')"
            >了解详情</a-button
          >
        </a-col>
      </a-row>
      <a-divider style="margin-top:10px;" />
      <a-row
        class="w-100 "
        style="margin-top:10px;margin-bottom:40px;padding:0 40px;"
        type="flex"
        justify="flex-start"
        align="middle"
      >
        <span
          class="pointer"
          style="color:black;font-size:16px;text-align:left;font-weight:600;margin-left:20px;margin-bottom:40px;"
        >
          关于我们
        </span>
        <span
          class="pointer"
          style="color:black;font-size:16px;text-align:left;font-weight:600;margin-left:20px;margin-bottom:40px;"
        >
          联系我们
        </span>
      </a-row>
    </div>
  </div>
</template>

<script>
import Header from "../components/Header.vue";
import { bannerList } from "../services/getData";
export default {
  mounted() {
    console.log(JSON.stringify(this.imgList));
  },
  async created() {
    const result = await bannerList();
    console.log(result);
    if (!result.code) {
      this.$message.error("获取信息失败");
      return;
    }
    if (result.code == 0) {
      this.$message.error(result.msg);
      return;
    }
    if (result.code == 1) {
      this.imgList = result.msg;
    }
  },
  components: {
    Header,
  },
  methods: {
    toLive() {
      location.href = location.origin + "/live";
    },
  },
  data() {
    return {
      imgList: [
        {
          src:
            "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607601210039&di=ce5137cac87acf4071c64ddf34fb158b&imgtype=0&src=http%3A%2F%2Fp3.qhimg.com%2Ft01b2177d8d1290688d.jpg",
          url: "/",
        },
        {
          src:
            "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607601141800&di=b3cbf169b3cdb17bf57eb543cc102264&imgtype=0&src=http%3A%2F%2Fstatic.managershare.com%2Fuploads%2F2018%2F10%2F15395723069885.jpg%3Fimageview2%2F2%2Fw%2F760",
          url: "/",
        },
        {
          src:
            "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607601210038&di=112ecfa5efce58046d2c7542bc6f99aa&imgtype=0&src=http%3A%2F%2Fwap.yesky.com%2FuploadImages%2F2017%2F091%2F18%2F47608TF0ZVA2_P1120483.JPG",
          url: "/",
        },
        {
          src:
            "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1607603260166&di=b4f27cada4566fb9df4a3db7a82d3adb&imgtype=0&src=http%3A%2F%2Fattach.bbs.miui.com%2Fforum%2F201501%2F29%2F154912worftckqkkv55trf.jpg",
          url: "/",
        },
      ],
    };
  },
};
</script>

<style scoped>
/* For demo */
.ant-carousel >>> .slick-slide {
  text-align: center;
  height: 160px;
  line-height: 160px;
  background: #364d79;
  overflow: hidden;
}
._header {
  padding: 20px 150px;
  text-align: left;
  font-size: 16px;
  color: #fff;
  background-color: transparent;
}
.bg-card {
  cursor: default;
  padding: 20px;
  box-sizing: border-box;
}
.bg-card:hover {
  background-color: #f5f7fa;
}

.header-container {
  color: #fff;
  margin: 0 40px;
  opacity: 0.7;
  font-size: 16px;
  background-color: rgba(31, 45, 61, 0.11);
}
.header-container:hover {
  opacity: 1;
}

.ant-carousel >>> .custom-slick-arrow {
  width: 25px;
  height: 25px;
  font-size: 25px;
  color: #fff;
  background-color: rgba(31, 45, 61, 0.11);
  opacity: 0.3;
}
.ant-carousel >>> .custom-slick-arrow:before {
  display: none;
}
.ant-carousel >>> .custom-slick-arrow:hover {
  opacity: 0.5;
}

.ant-carousel >>> .slick-slide h3 {
  color: #fff;
}
</style>
