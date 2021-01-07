<template>
  <div>
    <span :class="getClassName">{{ obj.username }}：</span>
    <span class="chat-room-content">{{ obj.content }}</span>
  </div>
</template>

<script>
export default {
  props: {
    obj: Object,
  },
  mounted() {},
  computed: {
    getClassName() {
      if (this.obj.username == this.$store.state.loginInfo["username"]) {
        return "chat-room-me";
      }
      return "chat-room-name";
    },
  },
};
</script>

<style lang="less" scoped>
.chat-room-me {
  display: inline-block;
  max-width: 8em;
  white-space: nowrap;
  margin-left: 5px;
  word-wrap: normal;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: 400;
  color: #eb7629 !important;
  cursor: pointer;
  font-size: 14px;
}
.chat-room-name {
  display: inline-block;
  max-width: 8em;
  white-space: nowrap;
  margin-left: 5px;
  word-wrap: normal;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: 400;
  color: #3c9cfe !important;
  cursor: pointer;
  font-size: 14px;
}
.chat-room-content {
  display: inline-block;
  max-width: 8em;
  white-space: nowrap;
  word-wrap: normal;
  overflow: hidden;
  text-overflow: ellipsis;
  font-weight: 400;
  font-size: 14px;
  color: whitesmoke !important;
}
</style>
