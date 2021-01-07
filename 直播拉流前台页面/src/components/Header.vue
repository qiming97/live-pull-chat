<template>
  <a-affix :offset-top="0" class="w-100" style="width:100%!important;">
    <div class="header" style="padding: 0 auto!important;">
      <div class="header-container">
        <!-- left -->
        <div style="margin-left:105px;">
          <slot name="left">
            <span v-if="title" style="font-size:14px;font-weight:200;">{{
              title
            }}</span>
          </slot>
        </div>
        <!-- right -->
        <div v-if="!$store.state.loginInfo.token">
          <a-button type="primary" style="border-radius:20px;" @click="login">
            登陆
          </a-button>
          <a-button
            type="danger"
            style="border-radius:20px;margin-left:5px;"
            @click="register"
          >
            注册
          </a-button>
        </div>
        <div v-else>
          <a-button
            type="danger"
            style="border-radius:20px;margin-left:5px;"
            @click="logout"
          >
            退出登陆
          </a-button>
        </div>
      </div>
    </div>
  </a-affix>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      default: "",
    },
  },
  mounted() {},
  methods: {
    logout() {
      this.$message.success("退出成功");
      this.$store.state.loginInfo = {};
      location.reload();
    },
    login() {
      this.$router.push("/login");
    },
    register() {
      this.$router.push("/register");
    },
  },
};
</script>

<style lang="less" scoped></style>
