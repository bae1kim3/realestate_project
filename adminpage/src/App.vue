<template>
  <h1
    style="margin: 0px; padding: 20px 0px; letter-spacing: 10px; font-weight: 900; background-color: #73685d; color: white; width: 100%; min-width: 1910px;"
  >
    관리자 페이지
  </h1>
  <div style="display: flex; /*  background-color: bisque; color: brown */" >
    <div id="sidebar">

      <h2 style="font-size: 35px;  margin-top: 20px; margin-bottom: 50px; max-width: 240px; font-weight: 600;">관리자 메뉴</h2>
      <a @click="$store.commit('droptoggle');" style="cursor: pointer;"
        ><p style="margin: 30px 0px 10px; font-size: 20px;  max-width: 240px; font-weight: 600;">회원 목록</p></a
      >
      <div v-if="$store.state.drop" >
        <a @click="$store.commit('printList', 0); $store.commit('serarchReset'); $store.dispatch('getUserStateList',1);" style="cursor: pointer;"
          ><p style="margin: 5px 0px;  max-width: 240px;">-사용자 목록-</p></a
        >
        <a @click="$store.commit('printList', 1); $store.commit('serarchReset'); $store.dispatch('getUserStateList',1);" style="cursor: pointer;"
          ><p style="margin: 5px 0px 20px; max-width: 240px;">-공인중개사 목록-</p></a
        >
      </div>
      <a @click="$store.commit('printList', 2); $store.commit('serarchReset'); $store.dispatch('getUserStateList',1);" style="cursor: pointer;"
        ><p style="margin: 10px 0px; font-size: 20px;  max-width: 240px; font-weight: 600;">매물 목록</p></a
      >
    </div>
    <div style="margin: 0 auto" v-if="!$store.state.login">
      <Loginpage></Loginpage>
    </div>
    <div style="margin: 0 auto" v-if="$store.state.login">
      <Admin_main></Admin_main>
    </div>
        <Modal></Modal>
  </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'
import Admin_main from "./components/Admin_main.vue";
import Loginpage from './components/Loginpage.vue';
import Modal from './components/Modal.vue';
export default {
  name: "App",
  created() {
    this.$store.dispatch("getUserStateList");
  },
  components: {
    Admin_main,
    Loginpage,
    Modal,
  },
};
</script>

<style>
@import url("./assets/css/common.css");
a {
  text-decoration: none;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
