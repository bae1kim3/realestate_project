import { createStore } from "vuex";
import axios from "axios";


const header = {
  "Content-Type": "application/json",
  "Access-Control-Allow-Origin": "*",
};
const store = createStore({
  state() {
    return {
      userList: [],
      stateList: [],
      userNumber: [],
      stateNumber: [],
      listNumber: 0,
      maxIndiUserPageNum: 0,
      maxRealtorUserPageNum: 0,
      maxStatesPageNum: 0,
      login: false,
      AdminId: '',
      AdminPw: '',
      searchWorld: '',
      modalFlg: false,
      drop: false,
    };
  },
  mutations: {
    createUserList(state, data) {
      state.userList["indi"] = data.indiUser;
      state.userList["realtor"] = data.realtorUser;
      state.stateList = data.states;
      state.maxIndiUserPageNum = data.max_indiUserPageNum;
      state.maxRealtorUserPageNum = data.max_realtorUserPageNum;
      state.maxStatesPageNum = data.max_statesPageNum;
    },
    userIdStateNumListReset(state){
      state.userNumber = [];
      state.stateNumber = [];
    },
    userIdList(state, Id) {
      if (state.userNumber.indexOf(Id) != -1) {
        state.userNumber.splice(state.userNumber.indexOf(Id), 1);
      } else {
        state.userNumber.push(Id);
      }
    },
    stateNumber(state, Id) {
      if (state.stateNumber.indexOf(Id) != -1) {
        state.stateNumber.splice(state.stateNumber.indexOf(Id), 1);
      } else {
        state.stateNumber.push(Id);
      }
    },
    printList(state, num) {
      state.listNumber = num;
    },
    login(state){
      state.login = true;
    },
    serarchReset(state){
      state.searchWorld = '';
    },
    modalOpen(state){
      if(state.userNumber.length != 0){
        state.modalFlg = true;
      }else{
        alert('선택하신 회원이 없습니다.');
      }
    },
    modalClose(state){
      state.modalFlg = false;
    },
    statemodalOpen(state){
      if(state.stateNumber.length != 0){
        state.modalFlg = true;
      }else{
        alert('선택하신 매물이 없습니다.');
      }
    },
    droptoggle(state){
      state.drop = !state.drop;
    }
  },
  actions: {
    getUserStateList(context,num) {
      if(context.state.login){
        if(!num){
          num = 1;
        }
        axios
          // .get("http://192.168.0.129/api/admin", header)
          .get("http://192.168.0.129/api/admin/" + num, header)
          .then((res) => {
            context.commit("createUserList", res.data);
            context.commit("userIdStateNumListReset");
          })
          .catch(() => alert('정보를 불러오지 못했습니다.'));
      }
    },
    deleteUser(context) {
      if (context.state.userNumber.length != 0) {
        axios
          .delete("http://192.168.0.129/api/admin", {
            data: { usersNumber: context.state.userNumber },
            header,
          })
          .then(() => {
            this.dispatch("getUserStateList");
          })
          .catch(() => alert('정보를 불러오지 못했습니다.'));
      }
    },
    deleteStateList(context) {
      if (context.state.stateNumber.length != 0) {
        axios
          .delete("http://192.168.0.129/api/admin", {
            data: { stateNumber: context.state.stateNumber },
            header,
          })
          .then(() => {
            this.dispatch("getUserStateList");
          })
          .catch(() => alert('정보를 불러오지 못했습니다.'));
      }
    },
    adminLoginCheck(context){
      if(context.state.AdminId == '' && context.state.AdminPw == ''){
        alert('정보를 입력해 주세요');
      }
      else if(context.state.AdminId == ''){
        alert('아이디를 입력해 주세요');
      }else if(context.state.AdminPw == ''){
        alert('비밀번호를 입력해 주세요');
      }else {
        axios
        .post("http://192.168.0.129/api/admin", {
          data: { AdminId: context.state.AdminId, AdminPw: context.state.AdminPw },
          header,
        })
        .then((res) => {
          if(res.data == 1){
            context.commit('login');
            this.dispatch("getUserStateList");
          }else{
            alert('입력하신 계정이 없습니다.');
          }
        })
        .catch(() => alert('정보를 불러오지 못했습니다.'));
      }
      },
      search(context,num) {
        if(!num){
          num = 1;
        }
        if(context.state.searchWorld != ''){
          axios
          .get(`http://192.168.0.129/api/admin/${context.state.searchWorld}/${context.state.listNumber}/${num}`, 
            header)
          .then((res) => {
            if(res.data.err){
              alert(`${res.data.err}`);
            }else{
              context.commit("createUserList", res.data);
            }
          })
          .catch(() => alert('정보를 불러오지 못했습니다.'));
        }else{
          this.dispatch("getUserStateList");
        }
      },
    }
  },
);
export default store;
