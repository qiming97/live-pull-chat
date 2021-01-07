<template>
  <div
    class="w-100 h-100"
    style="background-color: #f4f6f9;padding:166px 10px;"
  >
    <a-row style="min-width:480px;">
      <a-col :span="6"></a-col>
      <a-col
        :span="12"
        style="background-color: #fff;border-radius: 3px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);"
      >
        <a-form
          style="border-top: 2px solid #D75455;padding:0 30px;"
          id="components-form-demo-normal-login"
          :form="form"
          class="login-form"
          @submit="handleSubmit"
        >
          <a-form-item style="text-align:left;">
            <span
              style="line-height: 28px;color: #D75455;font-weight: 700;font-size:16px;"
              >登陆</span
            >
          </a-form-item>
          <a-form-item>
            <a-input
              v-model="userName"
              v-decorator="[
                'userName',
                {
                  rules: [{ required: true, message: '请输入用户名' }],
                },
              ]"
              placeholder="用户名"
            >
              <a-icon
                slot="prefix"
                type="user"
                style="color: rgba(0,0,0,.25)"
              />
            </a-input>
          </a-form-item>
          <a-form-item>
            <a-input
              v-decorator="[
                'password',
                {
                  rules: [{ required: true, message: '请输入密码' }],
                },
              ]"
              type="password"
              placeholder="密码"
              v-model="pwd"
            >
              <a-icon
                slot="prefix"
                type="lock"
                style="color: rgba(0,0,0,.25)"
              />
            </a-input>
          </a-form-item>
          <a-form-item>
            <!-- <a class="login-form-forgot" href="">
              Forgot password
            </a> -->
            <a-button
              type="primary"
              html-type="submit"
              id="login-btn"
              class="login-form-button"
              @click="login"
            >
              登陆
            </a-button>
          </a-form-item>
        </a-form>
      </a-col>
      <a-col :span="6"></a-col>
    </a-row>
  </div>
</template>

<script>
import { Login } from "../services/getData";
export default {
  data() {
    return {};
  },
  beforeCreate() {
    this.form = this.$form.createForm(this, { name: "normal_login" });
  },
  mounted() {
    if (this.$store.state.loginInfo.token) {
      return history.go(-1);
    }
  },
  methods: {
    async login() {
      if (this.userName == "" || this.pwd == "") {
        return;
      }

      let pwd = this.$md5(this.pwd + "helloworld");

      let result = await Login({
        username: this.userName,
        password: pwd,
      });
      console.log(result);
      if (result.code == 0) {
        return this.$message.error(result.msg);
      }
      if ((result.code = 1)) {
        //
        this.$message.success("登陆成功");
        this.$store.state.loginInfo = result.data;

        return history.go(-1);
      }
    },
    handleSubmit(e) {
      e.preventDefault();
      this.form.validateFields((err, values) => {
        if (!err) {
          console.log("Received values of form: ", values);
        }
      });
    },
  },
};
</script>
<style>
#components-form-demo-normal-login .login-form {
  max-width: 300px;
}
#components-form-demo-normal-login .login-form-forgot {
  float: right;
}
#components-form-demo-normal-login .login-form-button {
  width: 100%;
}

#login-btn {
  box-shadow: 0 2px 6px #acb5f6;
  background-color: #d75455;
  border-color: #d75455;
}
#login-btn:hover {
  box-shadow: 0 2px 6px #acb5f6;
  background-color: #007bff;
  border-color: #007bff;
}
</style>
