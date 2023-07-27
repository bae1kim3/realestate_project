<template>
    <div class="bg_black" style="width: 100%; height: 100%; background-color: white; border-radius: 0;">
        <div class="bg_white" style="width: 30%; height: 50%; margin-top: 240px ;">
            <h2 style="color: white; margin-top: 50px;">관리자 페이지 로그인</h2>
            <form style="margin-top: 100px;">
                <p>
                    <label for="admin_id"  style="width: 30px; height: 40px; color: white;">ID</label>
                    <input type="text" id="admin_id" v-model.trim="$store.state.AdminId" autocomplete="username" style="width: 250px; height: 40px;" placeholder="ID를 입력해 주세요">
                </p>
                <p>
                    <label for="admin_pw" style="width: 30px; height: 40px; color: white;">PW</label>
                    <input type="password" id="admin_pw" v-model.trim="$store.state.AdminPw" autocomplete="current-password" style="width: 250px; height: 40px;" placeholder="PW를 입력해 주세요">
                </p>
            </form>
            <button @click="$store.dispatch('adminLoginCheck')" style="background-color: #55493e;"
                type="button" class="btn btn-dark">Login</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Loginpage',
}
</script>
<style>
    
</style>