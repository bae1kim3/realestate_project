<x-app-layout>
    <div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
        <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 text-center mt-5">
        <h1 class="heading" data-aos="fade-up">비밀번호 찾기</h1>

        <nav
          aria-label="breadcrumb"
          data-aos="fade-up"
          data-aos-delay="200"
        >
          <ol class="breadcrumb text-center justify-content-center">
            <li class="breadcrumb-item"><a href="index.html">메인</a></li>
            <li
              class="breadcrumb-item active text-white-50"
              aria-current="page"
            >
              비밀번호 찾기
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="section bg-light">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row justify-content-center">
            <div class="col-lg-20 text-center mt-5">
                <div class="box-feature mb-4">
          <span class="icon-check"></span>
          <h3 class="text-black mb-3 font-weight-bold">
            비밀번호 찾기
         </h3>
          <p class="text-black-50">
           비밀번호를 찾으려면 이메일과 전화번호를 입력해 주세요
          </p>
          <div>
            <form action="{{ route('find-userpass') }}" method="post">
                <x-label for="email" value="{{ __('이메일') }}" class="dark:text-gray-100" />
                <x-input type="email" name="email" placeholder="이메일 입력"
                    class="block mt-1 w-full dark:bg-gray-700 dark:text-white" />
                <br>
                <x-label for="phone_no" value="{{ __('전화번호') }}" class="dark:text-gray-100" />
                <x-input type="text" name="phone_no" placeholder="전화번호 입력"
                    class="block mt-1 w-full dark:bg-gray-700 dark:text-white" style="margin-right: 10px"/>
                <br />
                <x-button class="btn btn-primary py-2 px-3" style="margin-top: 10px">입력</x-button>
                @if (Session::has('error_message'))
                    <div class="alert alert-danger">
                        {{ Session::get('error_message') }}
                    </div>
                @endif
            </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
