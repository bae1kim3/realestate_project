<x-app-layout>
<div class="hero page-inner overlay" style="background-image: url('{{ asset('images/hero_bg_1.jpg') }}')">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">이메일 인증</h1>

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
                  Services
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
                <div class="col-lg-9 text-center mt-5">
                    <div class="box-feature mb-4">
              <span class="icon-check"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                이메일 인증
             </h3>
              <p class="text-black-50">
               메일에 접속해서 이메일 인증을 완료해 주세요
              </p>
              <div>
                <button type="submit" class="btn btn-primary py-2 px-3">
                    이메일 재전송
                </button>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
