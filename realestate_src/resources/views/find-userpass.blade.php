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
           비밀번호를 회원가입시 저장한 답변을 입력해 주세요
          </p>
          <div>
            <form action="{{ route('password-reset') }}" method="post">
                <x-label for="pw_answer" class="block dark:text-white">질문: {{ session('pw_question') }}</x-label><br>
                <x-input type="text" wire:model="pw_answer" placeholder="답변 입력"
                    class="block mt-1 w-full dark:bg-gray-700 dark:text-white" />
                <br /><br>
                <x-button class="btn btn-primary py-2 px-3">비밀번호 찾기</x-button>
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
