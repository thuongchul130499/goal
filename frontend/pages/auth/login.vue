<template>
  <div id="white" class="bg-white-500 text-white">
    <img class="wave" src="~/assets/images/wave.png" />
    <div class="container">
      <div class="img">
        <img src="~/assets/images/bg.svg" />
      </div>
      <div class="login-content text-white">
        <form @submit.prevent="login">
          <img src="~/assets/images/avatar.svg" />
          <h2 class="title text-gray">Welcome</h2>
          <div class="input-div one" ref="email">
            <div class="i">
              <i class="fa fa-user"></i>
            </div>
            <div class="div">
              <h5 class="text-gray">Email</h5>
              <input
                type="email"
                class="input"
                id="email"
                @focus="onFocus($event,'email')"
                @blur="onBlur($event,'email')"
                v-model="email"
              />
            </div>
          </div>
          <div class="input-div pass" ref="password">
            <div class="i">
              <i class="fa fa-lock"></i>
            </div>
            <div class="div">
              <h5 class="text-gray">Password</h5>
              <input
                type="password"
                class="input"
                id="password"
                @focus="onFocus($event, 'password')"
                @blur="onBlur($event,'password')"
                v-model="password"
              />
            </div>
          </div>
          <a href="#" class="text-gray">Forgot Password?</a>
          <input type="submit" class="btn" value="Login" />
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      focus: false,
      email: "",
      password: "",
      loading: false
    };
  },
  methods: {
    onFocus(e, ref) {
      if (e.target.value.length) {
        return;
      }
      this.$refs[ref].classList.add("focus");
    },
    onBlur(e, ref) {
      if (e.target.value.length) {
        return;
      }
      this.$refs[ref].classList.remove("focus");
    },
    login() {}
  }
};
</script>
<style scoped lang="scss">
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
body {
  font-family: "Poppins", sans-serif;
  overflow: hidden;
}
.wave {
  position: fixed;
  bottom: 0;
  left: 0;
  height: 100%;
  z-index: 1;
}
.container {
  margin: auto;
  width: 100vw;
  height: 100vh;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap: 7rem;
  padding: 0 2rem;
}
.img {
  z-index: 2;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  img {
    width: 500px;
  }
}
.login-content {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  text-align: center;
  img {
    height: 100px;
  }
  h2 {
    margin: 15px 0;
    color: #333;
    text-transform: uppercase;
    font-size: 2.9rem;
  }
  .input-div {
    position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
  }
  .input-div.one {
    margin-top: 0;
  }
}
form {
  width: 360px;
}
.i {
  color: #d9d9d9;
  display: flex;
  justify-content: center;
  align-items: center;
  i {
    transition: 0.3s;
  }
}
.input-div {
  > div {
    position: relative;
    height: 45px;
    > h5 {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 18px;
      transition: 0.3s;
    }
    > input {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      border: none;
      outline: none;
      background: none;
      padding: 0.5rem 0.7rem;
      font-size: 1.2rem;
      color: #555;
      font-family: "poppins", sans-serif;
    }
  }
  &:before {
    content: "";
    position: absolute;
    bottom: -2px;
    width: 0%;
    height: 2px;
    background-color: #38d39f;
    transition: 0.4s;
    right: 50%;
  }
  &:after {
    content: "";
    position: absolute;
    bottom: -2px;
    width: 0%;
    height: 2px;
    background-color: #38d39f;
    transition: 0.4s;
    left: 50%;
  }
}
.input-div.focus {
  &:before {
    width: 50%;
  }
  &:after {
    width: 50%;
  }
  > div {
    > h5 {
      top: -5px;
      font-size: 15px;
    }
  }
  > .i {
    > i {
      color: #38d39f;
    }
  }
}
.input-div.pass {
  margin-bottom: 4px;
}
a {
  display: block;
  text-align: right;
  text-decoration: none;
  color: #999;
  font-size: 0.9rem;
  transition: 0.3s;
  &:hover {
    color: #38d39f;
  }
}
.btn {
  display: block;
  width: 100%;
  height: 50px;
  border-radius: 25px;
  outline: none;
  border: none;
  background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
  background-size: 200%;
  font-size: 1.2rem;
  color: #fff;
  font-family: "Poppins", sans-serif;
  text-transform: uppercase;
  margin: 1rem 0;
  cursor: pointer;
  transition: 0.5s;
  &:hover {
    background-position: right;
  }
}
@media screen and (max-width: 1050px) {
  .container {
    grid-gap: 5rem;
  }
}
@media screen and (max-width: 1000px) {
  form {
    width: 290px;
  }
  .login-content {
    h2 {
      font-size: 2.4rem;
      margin: 8px 0;
    }
  }
  .img {
    img {
      width: 400px;
    }
  }
}
@media screen and (max-width: 900px) {
  .container {
    grid-template-columns: 1fr;
  }
  .img {
    display: none;
  }
  .wave {
    display: none;
  }
  .login-content {
    justify-content: center;
  }
}
</style>