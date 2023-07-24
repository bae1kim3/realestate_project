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
           비밀번호를 회원가입시 입력한 답변을 입력해 주세요
          </p>
          <div>
            <form action="{{ route('updatePassword') }}" method="post">
                @csrf
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('새 비밀번호') }}" class="dark:text-white"/>
                        <x-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('비밀번호 확인') }}" class="dark:text-white"/>
                        <x-input id="password_confirmation" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="btn btn-primary py-2 px-3">
                        저장
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
