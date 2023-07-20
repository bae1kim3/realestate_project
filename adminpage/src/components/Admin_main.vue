<template>
  <div>
    <div
      v-if="$store.state.listNumber == 0"
      style="
        height: 88vh;
        display: flex;
        align-items: center;
        flex-direction: column;
      "
    >
      <h2 style="margin-top: 30px">개인유저 리스트</h2>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>번호</th>
            <th>이름</th>
            <th>이메일</th>
            <th>휴대폰 번호</th>
            <th>비밀번호 질문</th>
            <th>비밀번호 답변</th>
            <th>주소</th>
            <th>아이디</th>
            <th>권한</th>
            <th>가입 날짜</th>
            <th>
              <button
                @click="$store.dispatch('deleteUser')"
                style="color: black"
              >
                삭제
              </button>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in $store.state.userList['indi']" :key="data">
            <td>
              <input
                @change="$store.commit('userIdList', data.id)"
                type="checkbox"
                class="indiuser"
              />
            </td>
            <td>{{ data.id }}</td>
            <td>{{ data.name }}</td>
            <td>{{ data.email }}</td>
            <td>{{ data.phone_no }}</td>
            <td>{{ data.pw_question }}</td>
            <td>{{ data.pw_answer }}</td>
            <td>{{ data.u_addr }}</td>
            <td>{{ data.u_id }}</td>
            <td>{{ data.u_at }}</td>
            <td>{{ data.created_at }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="$store.state.listNumber == 1">
      <h2 style="margin-top: 30px">공인중개사 리스트</h2>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>번호</th>
            <th>이름</th>
            <th>이메일</th>
            <th>휴대폰 번호</th>
            <th>비밀번호 질문</th>
            <th>비밀번호 답변</th>
            <th>라이센스 번호</th>
            <th>주소</th>
            <th>아이디</th>
            <th>권한</th>
            <th>가입 날짜</th>
            <th>
              <button
                @click="$store.dispatch('deleteUser')"
                style="color: black"
              >
                삭제
              </button>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in $store.state.userList['realtor']" :key="data">
            <td>
              <input
                @change="$store.commit('userIdList', data.id)"
                type="checkbox"
                class="realtor"
              />
            </td>
            <td>{{ data.id }}</td>
            <td>{{ data.name }}</td>
            <td>{{ data.email }}</td>
            <td>{{ data.phone_no }}</td>
            <td>{{ data.pw_question }}</td>
            <td>{{ data.pw_answer }}</td>
            <td>{{ data.seller_license }}</td>
            <td>{{ data.u_addr }}</td>
            <td>{{ data.u_id }}</td>
            <td>{{ data.u_at }}</td>
            <td>{{ data.created_at }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="$store.state.listNumber == 2">
      <h2 style="margin-top: 30px">매물 리스트</h2>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>번호</th>
            <th>이름</th>
            <th>주소</th>
            <th>매매유형</th>
            <th>가격</th>
            <th>대형동물 가능 여부</th>
            <th>평수</th>
            <th>층수</th>
            <th>가까운 역</th>
            <th>올린 유저 번호</th>
            <th>작성 날짜</th>
            <th>
              <button
                @click="$store.dispatch('deleteStateList')"
                style="color: black"
              >
                삭제
              </button>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in $store.state.stateList" :key="data">
            <td>
              <input
                @change="$store.commit('stateNumber', data.s_no)"
                type="checkbox"
                class="state"
              />
            </td>
            <td>{{ data.s_no }}</td>
            <td>{{ data.s_name }}</td>
            <td>{{ data.s_add }}</td>
            <td>{{ data.s_type }}</td>
            <td>{{ data.p_deposit }}</td>
            <td>{{ data.animal_size }}</td>
            <td>{{ data.s_size }}</td>
            <td>{{ data.s_fl }}</td>
            <td>{{ data.s_stai }}</td>
            <td>{{ data.u_no }}</td>
            <td>{{ data.created_at }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  name: "Admin_main",
};
</script>
<style></style>
