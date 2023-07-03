<x-app-layout>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('nav.css') }}">
    <link rel="stylesheet" href="{{ asset('welcome.css') }}">
    <body class="antialiased">


        <div x-bind:class="{ 'dark-bg-image-1': darkMode, 'dark-bg-image-2': !darkMode }">
        <div style="line-height: 40vh;">
            <label for="search" style="font-size: 20px; vertical-align:middle;" class="font-bold text-black dark:text-white">매물 검색</label>
            <input type="text" style="height: 40px;" class="rounded-lg px-2 py-1 dark:bg-gray-800 dark:text-white" name="search" id="search" placeholder="역이름, 주소로 검색해 주세요">
            <button onclick="searchProperties()" style="font-size: 15px; width: 80px; height: 40px;" class="py-2 px-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-gray-400">검색</button>
        </div>
        </div>

        {{-- <div
            class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-center">
                            <a class="dark:text-white" href="{{ route('map.map') }}" style="margin-right: 20px;">지도</a>
            @if (session('seller_license'))
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-white dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">매물올리기</a>
            @endif
                        </div>
                    @elseif(session('u_id'))
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">로그인</a>
                        @if (Auth::user())
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">회원가입</a>
                        @endif
                    @endauth
                </div> --}}

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <br>
                <br>
                <br>
                <div x-bind:class="{ 'scroll-container1': darkMode, 'scroll-container': !darkMode }" id="scroll-container" class="scroll-item">
                    @foreach ($photos as $photo)
                        <a href="{{ route('struct.detail', ['s_no' => $photo->s_no]) }}">
                            <div class="photo-item" style="background-image: url('{{ asset($photo->url) }}');">
                                <span class="photo-info">
                                    <span class="info-text">{{ $photo->s_add }}</span><br>
                                    <span class="info-text">{{ number_format($photo->p_deposit) }}</span>
                                    @if ($photo->s_type === '월세')
                                        <span class="info-text"> / {{ number_format($photo->p_month) }}</span>
                                    @endif
                                    <br><span class="info-text">{{ substr($photo->updated_at, 0, 10) }}</span>
                                </span>
                            </div>
                        </a>
                        <input type="hidden" id="lastPhotoItem" data-id="{{ $lastPhotoId }}">
                    @endforeach
                </div>
                <br>
                <div class="flex items-start gap-8">
                    <div class="w-1/2">
                        <h2 class="text-2xl font-bold mb-4 dark:text-white">동물보호센터</h2>
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">대구유기동물보호협회</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">전화번호 : 053-964-6258</p>
                                    <p class="dark:text-white">주소 : 대구광역시 동구 금강로 151-13 (금강동)</p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">동행동물병원</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">전화번호 : 053-636-8720</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달서구 진천로 117 (대천동) 117,118 호</p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">멘토동물병원</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">전화번호 : 053-291-7579</p>
                                    <p class="dark:text-white">주소 : 대구광역시 수성구 용학로 294 (범물동) 2층</p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white dark:text-white">
                                    세인트동물병원</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">전화번호 : 053-744-8285</p>
                                    <p class="dark:text-white">주소 : 대구광역시 수성구 청호로 484 (만촌동)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-8 border-gray-300">
                    <div class="w-1/2">
                        <h2 class="text-2xl font-bold mb-4 dark:text-white">응급동물병원</h2>
                        <div class="accordion">
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">북구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">플러스동물의료센터</p>
                                    <p class="dark:text-white">전화번호 : 053-424-2455</p>
                                    <p class="dark:text-white">주소 : 대구광역시 북구 중앙대로 526</p>
                                    <hr>
                                    <p class="dark:text-white">가온동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-958-0075</p>
                                    <p class="dark:text-white">주소 : 대구광역시 북구 서변동 1746-9</p>
                                    <hr>
                                    <p class="dark:text-white">해솔동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-959-7775</p>
                                    <p class="dark:text-white">주소 : 대구광역시 북구 대현동 340-15</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">서구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">삼성동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-556-8575</p>
                                    <p class="dark:text-white">주소 : 대구광역시 서구 내당4동 서대구로 37</p>
                                    <hr>
                                    <p class="dark:text-white">진동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-554-3575</p>
                                    <p class="dark:text-white">주소 : 대구광역시 서구 비산2.3동 국채보상로 407</p>
                                    <hr>
                                    <p class="dark:text-white">가야동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-558-3037</p>
                                    <p class="dark:text-white">주소 : 대구광역시 서구 평리동 1522-3</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">중구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">센트럴동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-214-5577</p>
                                    <p class="dark:text-white">주소 : 대구광역시 중구 대신동 1424</p>
                                    <hr>
                                    <p class="dark:text-white">최우식동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-767-1588</p>
                                    <p class="dark:text-white">주소 : 대구광역시 중구 남산4동</p>
                                    <hr>
                                    <p class="dark:text-white">중부동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-253-8278</p>
                                    <p class="dark:text-white">주소 : 대구광역시 중구 봉산동 53-2</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">남구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">박순석동물메디컬센터</p>
                                    <p class="dark:text-white">전화번호 : 053-657-0959</p>
                                    <p class="dark:text-white">주소 : 대구광역시 남구 대명로 72 더원빌딩 2층</p>
                                    <hr>
                                    <p class="dark:text-white">현대동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-475-5259</p>
                                    <p class="dark:text-white">주소 : 대구광역시 남구 봉덕로 89</p>
                                    <hr>
                                    <p class="dark:text-white">중앙동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-625-9198</p>
                                    <p class="dark:text-white">주소 : 대구광역시 남구 대명6동 1111</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">수성구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">24시범어동물의료센터</p>
                                    <p class="dark:text-white">전화번호 : 053-716-7585</p>
                                    <p class="dark:text-white">주소 : 대구광역시 수성구 수성동3가 10</p>
                                    <hr>
                                    <p class="dark:text-white">대구시지동물병원</p>
                                    <p class="dark:text-white">전화번호 : 070-8862-5945</p>
                                    <p class="dark:text-white">주소 : 대구광역시 수성구 달구벌대로 3014</p>
                                    <hr>
                                    <p class="dark:text-white">조은동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-742-0075</p>
                                    <p class="dark:text-white">주소 : 대구광역시 수성구 만촌동 달구벌대로 2562</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">동구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">봄이온동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-962-3264</p>
                                    <p class="dark:text-white">주소 : 대구광역시 동구 각산동 444-7번지 101호</p>
                                    <hr>
                                    <p class="dark:text-white">수호동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-982-0275</p>
                                    <p class="dark:text-white">주소 : 대구광역시 동구 봉무동 1539-3 이시아시티빌딩 205호</p>
                                    <hr>
                                    <p class="dark:text-white">변수의과동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-983-2069</p>
                                    <p class="dark:text-white">주소 : 대구광역시 동구 검사동 957-41</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">달서구</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">대구24시바른동물의료센터</p>
                                    <p class="dark:text-white">전화번호 : 053-571-0075</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달서구 와룡로 142 2층</p>
                                    <hr>
                                    <p class="dark:text-white">24시라이프동물의료센터</p>
                                    <p class="dark:text-white">전화번호 : 053-567-2475</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달서구 감삼동 69-1 1층</p>
                                    <hr>
                                    <p class="dark:text-white">대구탑스동물메디컬센터</p>
                                    <p class="dark:text-white">전화번호 : 053-637-7501</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달서구 상인2동 월배로 166</p>
                                </div>
                            </div>
                            <div class="accordion-item2">
                                <div class="accordion-title font-bold cursor-pointer dark:text-white">달성군</div>
                                <div class="accordion-content">
                                    <p class="dark:text-white">화원연합동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-634-7975</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달성군 화원읍 천내리 156-1</p>
                                    <hr>
                                    <p class="dark:text-white">현풍동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-614-3570</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달성군 테크노공원로51 봉리타워 현풍동물병원 613 205호</p>
                                    <hr>
                                    <p class="dark:text-white">다사종합동물병원</p>
                                    <p class="dark:text-white">전화번호 : 053-591-7581</p>
                                    <p class="dark:text-white">주소 : 대구광역시 달성군 다사읍 죽곡리 23-6</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
        <script src="{{ asset('welcome.js') }}"></script>
    </body>
</x-app-layout>

</html>