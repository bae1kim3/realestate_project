<div style="text-align: center">
    @if (session('u_id'))
        <div style="margin-top: 10%; color: red;">
            <h1>아이디 찾기 완료</h1>
            <p>아이디: {{ session('u_id') }}</p>
            <a href="{{ route('login') }}">로그인하러 가기</a>
        </div>
    @else
        <div style="margin-top: 10%; color: red;">
            <p>사용자를 찾을 수 없습니다.</p>
        </div>
    @endif
    <br>
    <x-button id="btn3">확인</x-button>
</div>

<script>
    // 팝업 창 닫기
    const btn3 = document.getElementById("btn3");
    btn3.addEventListener("click", () => {
        window.close();
    });
</script>
