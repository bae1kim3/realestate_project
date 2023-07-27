<template>
  <div class="bg_black" v-if="$store.state.modalFlg && $store.state.listNumber == 0">
    <div class="bg_white">
        <hr>
        <h2 style="color: white;"><span style="color: red">{{$store.state.userNumber.length}}명</span>의 회원을 선택하셨습니다.<br>선택하신 회원들이 <span style="color: red">모두 탈퇴</span>됩니다.<br>탈퇴회원들은 되돌릴수 없습니다.<br><span style="color: red">탈퇴</span> 시키시겠습니까??</h2>
        <hr>
      <button @click="$store.dispatch('deleteUser'); $store.commit('modalClose');" style="background-color: #55493e; margin-right: 10px;"
                type="button" class="btn btn-dark">확인</button>
      <button @click="$store.commit('modalClose'); $store.dispatch('getUserStateList',1);" style="background-color: #55493e; margin-left: 10px; "
                type="button" class="btn btn-dark">취소</button>
    </div>
  </div>
  <div class="bg_black" v-if="$store.state.modalFlg && $store.state.listNumber == 1">
    <div class="bg_white">
        <hr>
        <h2 style="color: white;"><span style="color: red">{{$store.state.userNumber.length}}명</span>의 회원을 선택하셨습니다.<br>선택하신 회원들이 <span style="color: red">모두 탈퇴</span>됩니다.<br>탈퇴회원들은 되돌릴수 없습니다.<br><span style="color: red">탈퇴</span> 시키시겠습니까??</h2>
        <hr>
      <button @click=" $store.dispatch('deleteUser'); $store.commit('modalClose');" style="background-color: #55493e; margin-right: 10px;"
                type="button" class="btn btn-dark">확인</button>
      <button @click="$store.commit('modalClose'); $store.dispatch('getUserStateList',1);" style="background-color: #55493e; margin-left: 10px;"
                type="button" class="btn btn-dark">취소</button>
    </div>
  </div>
  <div class="bg_black" v-if="$store.state.modalFlg && $store.state.listNumber == 2">
    <div class="bg_white">
        <hr>
        <h2 style="color: white;"><span style="color: red">{{$store.state.stateNumber.length}}개</span>의 매물을 선택하셨습니다.<br>선택하신 매물들이 <span style="color: red">모두 삭제</span>됩니다.<br>삭제된 매물들은 되돌릴수 없습니다.<br><span style="color: red">삭제</span> 시키시겠습니까??</h2>
        <hr>
      <button @click="$store.dispatch('deleteStateList'); $store.commit('modalClose');" style="background-color: #55493e; margin-right: 10px;"
                type="button" class="btn btn-dark">확인</button>
      <button @click="$store.commit('modalClose'); $store.dispatch('getUserStateList',1);" style="background-color: #55493e; margin-left: 10px;"
                type="button" class="btn btn-dark">취소</button>
    </div>
  </div>
</template>
<script>
export default {
    name: 'Modal',
}
</script>
<style>
    div {
  box-sizing: border-box;
}
</style>