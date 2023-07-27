<template>
  <div>
    <div
      v-if="$store.state.listNumber == 0"
      style="
        display: flex;
        align-items: center;
        flex-direction: column;
      "
    >
    <div style="display: flex; justify-content: space-between; width: 100%;">
      <h3 style="margin: 20px 0; margin-left: 25px; font-weight:600; color: #af8965;">사용자 리스트</h3>
      <input style="width: 250px; height: 45px ; margin-top: 25px; margin-right: 20px; border-radius: 10px;" type="text" placeholder="검색어를 입력해 주세요." @change="$store.dispatch('search')" v-model.trim="$store.state.searchWorld">
    </div>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>번호</th>
            <th>이름</th>
            <th>아이디</th>
            <th>이메일</th>
            <th>휴대폰 번호</th>
            <th>주소</th>
            <th>가입 날짜</th>
            <th>
              <button
                @click="$store.commit('modalOpen')"
                style="background-color: #55493e;"
                type="button" class="btn btn-dark"
              >
                탈퇴
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
              />
            </td>
            <td>{{ data.id }}</td>
            <td>{{ data.name }}</td>
            <td>{{ data.u_id }}</td>
            <td>{{ data.email }}</td>
            <td>{{ phon(data.phone_no) }}</td>
            <td>{{ data.u_addr }}</td>
            <td>{{ dateChange(data.created_at) }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation example" style="margin-top: 10px;" v-if="$store.state.searchWorld == ''">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('getUserStateList')" aria-label="Previous" style="cursor: pointer; color:white ; background-color: #73685d;">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item" v-for="n in $store.state.maxIndiUserPageNum" :key="n" @click="$store.dispatch('getUserStateList', n)"><a class="page-link" href="#" style="color:white ; background-color: #73685d;">{{ n }}</a></li>
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('getUserStateList', $store.state.maxIndiUserPageNum)" aria-label="Next" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      <nav aria-label="Page navigation example" style="margin-top: 10px;" v-if="$store.state.searchWorld != ''">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('search')" aria-label="Previous" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item" v-for="n in $store.state.maxIndiUserPageNum" :key="n" @click="$store.dispatch('search', n)"><a class="page-link" href="#" style="color:#ffffff ; background-color: #73685d;">{{ n }}</a></li>
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('search', $store.state.maxIndiUserPageNum)" aria-label="Next" style="cursor: pointer; color:#ffffff ; background-color: #73685d; ">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <div v-if="$store.state.listNumber == 1" 
      style="
        display: flex;
        align-items: center;
        flex-direction: column;
      ">
    <div style="display: flex; justify-content: space-between; width: 100%;">
      <h3 style="margin: 20px 0; margin-left: 25px; font-weight:600; color: #af8965;">공인중개사 리스트</h3>
      <input style="width: 250px; height: 45px ; margin-top: 25px; margin-right: 20px; border-radius: 10px;" type="text" placeholder="검색어를 입력해 주세요." @change="$store.dispatch('search')" v-model.trim="$store.state.searchWorld">
    </div>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>번호</th>
            <th>이름</th>
            <th>아이디</th>
            <th>이메일</th>
            <th>휴대폰 번호</th>
            <th>라이센스 번호</th>
            <th>주소</th>
            <th>가입 날짜</th>
            <th>
              <button
                @click="$store.commit('modalOpen')"
                style="background-color: #55493e;"
                type="button" class="btn btn-dark"
              >
              탈퇴
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
              />
            </td>
            <td>{{ data.id }}</td>
            <td>{{ data.name }}</td>
            <td>{{ data.u_id }}</td>
            <td>{{ data.email }}</td>
            <td>{{ phon(data.phone_no) }}</td>
            <td>{{ data.seller_license }}</td>
            <td>{{ data.u_addr }}</td>
            <td>{{ dateChange(data.created_at) }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation example" style="margin-top: 10px;" v-if="$store.state.searchWorld == ''">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('getUserStateList')" aria-label="Previous" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item" v-for="n in $store.state.maxRealtorUserPageNum" :key="n" @click="$store.dispatch('getUserStateList', n)"><a class="page-link" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">{{ n }}</a></li>
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('getUserStateList', $store.state.maxRealtorUserPageNum)" aria-label="Next" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      <nav aria-label="Page navigation example" style="margin-top: 10px;" v-if="$store.state.searchWorld != ''">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('search')" aria-label="Previous" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item" v-for="n in $store.state.maxRealtorUserPageNum" :key="n" @click="$store.dispatch('search', n)"><a class="page-link" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">{{ n }}</a></li>
          <li class="page-item">
            <a class="page-link" @click="$store.dispatch('search', $store.state.maxRealtorUserPageNum)" aria-label="Next" style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <div v-if="$store.state.listNumber == 2"
      style="
        display: flex;
        align-items: center;
        flex-direction: column;
      ">
    <div style="display: flex; justify-content: space-between; width: 100%;">
      <h3 style="margin: 20px 0; margin-left: 25px; font-weight:600; color: #af8965;">매물 리스트</h3>
      <input style="width: 250px; height: 45px ; margin-top: 25px; margin-right: 20px; border-radius: 10px;" type="text" placeholder="검색어를 입력해 주세요." @change="$store.dispatch('search')" v-model.trim="$store.state.searchWorld">
    </div>
      <table>
        <thead>
          <tr>
            <th></th>
            <th>번호</th>
            <th>이름</th>
            <th>주소</th>
            <th>매매유형</th>
            <th>가격/월세(만원)</th>
            <th>대형동물 가능 여부</th>
            <th>평수(평)</th>
            <th>층수</th>
            <th>가까운 역</th>
            <th>올린 유저 번호</th>
            <th>작성 날짜</th>
            <th>
              <button
                @click="$store.commit('statemodalOpen')"
                style="background-color: #55493e;"
                type="button" class="btn btn-dark"
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
              />
            </td>
            <td>{{ data.s_no }}</td>
            <td><strong><a :href="'http://192.168.0.129/sDetail/' + data.s_no" target="_blank">{{ data.s_name }}</a></strong></td>
            <td>{{ data.s_add }}</td>
            <td>{{ data.s_type }}</td>
            <td>{{ comma(data.p_deposit) }}<b>/</b>{{ data.p_month ? comma(data.p_month) : 0 }}(만원)</td>
            <td>{{ data.animal_size == 0 ? '불가능' : '가능' }}</td>
            <td>{{ data.s_size }}(평)</td>
            <td>{{ data.s_fl }}층</td>
            <td>{{ data.s_stai }}역</td>
            <td >{{ data.u_no }}</td>
            <td>{{ dateChange(data.created_at )}}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
        <nav aria-label="Page navigation example" style="margin-top: 10px;" v-if="$store.state.searchWorld == ''">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" @click="$store.dispatch('getUserStateList')" aria-label="Previous"  style="cursor: pointer; color:#ffffff ; background-color: #73685d;">
                <span aria-hidden="true" >&laquo;</span>
              </a>
            </li>
            <li class="page-item" v-for="n in $store.state.maxStatesPageNum" :key="n" @click="$store.dispatch('getUserStateList', n)"><a class="page-link" href="#"  style="color:#ffffff ; background-color: #73685d;">{{ n }}</a></li>
            <li class="page-item">
              <a class="page-link" @click="$store.dispatch('getUserStateList', $store.state.maxStatesPageNum)" aria-label="Next"  style="cursor: pointer; color:#ffffff; background-color: #73685d; ">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
        <nav aria-label="Page navigation example" style="margin-top: 10px;" v-if="$store.state.searchWorld != ''">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" @click="$store.dispatch('search')" aria-label="Previous"  style="cursor: pointer; color:#ffffff; background-color: #73685d; ">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item" v-for="n in $store.state.maxStatesPageNum" :key="n" @click="$store.dispatch('search', n)"><a class="page-link" href="#" style="color:#ffffff; background-color: #73685d; ">{{ n }}</a></li>
            <li class="page-item">
              <a class="page-link" @click="$store.dispatch('search', $store.state.maxStatesPageNum)" aria-label="Next"  style="cursor: pointer; color:#ffffff; background-color: #73685d; ">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
    </div>
  </div>
</template>
<script>
import dayjs from 'dayjs'
export default {
  name: "Admin_main",
    component() {
        dayjs
    },
    methods: {
      dateChange(date){
        let data = dayjs(date).format('YYYY-MM-DD HH:mm:ss') ;
        return data;
      },
      comma(val){
        return String(val).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      },
      phon(num){
        return num.replace(/(\d{3})(\d{4})(\d{4})/, "$1-$2-$3");
      }
    },
};
</script>
<style></style>
