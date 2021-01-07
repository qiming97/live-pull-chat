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
              >注册</span
            >
          </a-form-item>
          <a-form-item>
            <a-input
              v-decorator="[
                'userName',
                {
                  rules: [{ required: true, message: '请输入用户名' }],
                },
              ]"
              placeholder="用户名"
              v-model="userName"
            >
              <a-icon
                slot="prefix"
                type="user"
                style="color: rgba(0,0,0,.25)"
              />
            </a-input>
          </a-form-item>
          <a-form-item has-feedback>
            <a-input
              v-decorator="[
                'password',
                {
                  rules: [
                    { required: true, message: '请输入密码' },
                    {
                      validator: validateToNextPassword,
                    },
                  ],
                },
              ]"
              type="password"
              placeholder="密码"
            >
              <a-icon
                slot="prefix"
                type="lock"
                style="color: rgba(0,0,0,.25)"
              />
            </a-input>
          </a-form-item>
          <a-form-item has-feedback>
            <a-input
              v-decorator="[
                'confirm',
                {
                  rules: [
                    { required: true, message: '请输入确认密码' },
                    {
                      validator: compareToFirstPassword,
                    },
                  ],
                },
              ]"
              type="password"
              @blur="handleConfirmBlur"
              placeholder="确认密码"
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
              @click="register"
            >
              注册
            </a-button>
            已有账号?
            <a href="/login">
              点我登陆! 👉
            </a>
          </a-form-item>
        </a-form>
      </a-col>
      <a-col :span="6"></a-col>
    </a-row>
  </div>
</template>

<script>
import { Register } from "../services/getData";
export default {
  data() {
    return {
      confirmDirty: false,
    };
  },
  beforeCreate() {
    this.form = this.$form.createForm(this, { name: "register" });
  },
  mounted() {
    if (this.$store.state.loginInfo.token) {
      return history.go(-1);
    }
  },
  methods: {
    async register() {
      if (this.userName == "" || this.pwd == "") {
        return;
      }

      let pwd = this.$md5(this.pwd + "helloworld");

      let result = await Register({
        username: this.userName,
        password: pwd,
      });
      console.log(result);
      if (result.code == 0) {
        return this.$message.error(result.msg);
      }
      if ((result.code = 1)) {
        //
        this.$message.success("注册成功");
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
    handleConfirmBlur(e) {
      const value = e.target.value;
      this.confirmDirty = this.confirmDirty || !!value;
    },
    compareToFirstPassword(rule, value, callback) {
      const form = this.form;
      if (value && value !== form.getFieldValue("password")) {
        callback("两次输入的密码不一致");
      } else {
        callback();
      }
    },
    validateToNextPassword(rule, value, callback) {
      const form = this.form;
      if (value && this.confirmDirty) {
        form.validateFields(["confirm"], { force: true });
      }
      callback();
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
