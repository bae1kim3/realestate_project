<template>
  <h1
    style="margin: 0px; padding: 20px; background-color: #73685d; color: white"
  >
    관리자 페이지
  </h1>
  <div style="display: flex; /*  background-color: bisque; color: brown */">
    <div id="sidebar">
      <h2>sidebar</h2>
      <a @click="$store.commit('printList', 0)" style="cursor: pointer"
        >개인유저 목록</a
      >
      <br />
      <a @click="$store.commit('printList', 1)" style="cursor: pointer"
        >공인중개사 목록</a
      >
      <br />
      <a @click="$store.commit('printList', 2)" style="cursor: pointer"
        >매물 목록</a
      >
      <br />
      <a href="#">공지사항</a>
    </div>
    <div style="margin: 0 auto">
      <Admin_main></Admin_main>
    </div>
  </div>
</template>

<script>
import Admin_main from "./components/Admin_main.vue";
export default {
  name: "App",
  created() {
    this.$store.dispatch("getUserStateList");
  },
  components: {
    Admin_main,
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
