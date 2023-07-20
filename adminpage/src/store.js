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
    };
  },
  mutations: {
    createUserList(state, data) {
      state.userList["indi"] = data.indiUser;
      state.userList["realtor"] = data.realtorUser;
      state.stateList = data.states;
      console.log(state.stateList);
    },
    userIdList(state, Id) {
      if (state.userNumber.indexOf(Id) != -1) {
        state.userNumber.splice(state.userNumber.indexOf(Id), 1);
      } else {
        state.userNumber.push(Id);
      }
      console.log(state.userNumber);
    },
    stateNumber(state, Id) {
      if (state.stateNumber.indexOf(Id) != -1) {
        state.stateNumber.splice(state.stateNumber.indexOf(Id), 1);
      } else {
        state.stateNumber.push(Id);
      }
      console.log(state.stateNumber);
    },
    printList(state, num) {
      state.listNumber = num;
    },
  },
  actions: {
    getUserStateList(context) {
      axios
        .get("http://127.0.0.1:8000/api/admin", header)
        .then((res) => {
          context.commit("createUserList", res.data);
        })
        .catch((err) => console.log(err));
    },
    deleteUser(context) {
      if (context.state.userNumber.length != 0) {
        axios
          .delete("http://127.0.0.1:8000/api/admin", {
            data: { usersNumber: context.state.userNumber },
            header,
          })
          .then(() => {
            this.dispatch("getUserStateList");
          })
          .catch((err) => console.log(err));
      }
    },
    deleteStateList(context) {
      if (context.state.stateNumber.length != 0) {
        axios
          .delete("http://127.0.0.1:8000/api/admin", {
            data: { stateNumber: context.state.stateNumber },
            header,
          })
          .then(() => {
            this.dispatch("getUserStateList");
          })
          .catch((err) => console.log(err));
      }
    },
  },
});
export default store;
