
<div id="footer">
    <footer >
        <div class="adress">
            <div class="adress-head">
                Наша адреса
            </div>
            <div class="adress-body">
                {{ $config->address }}
            </div>
        </div>
        <div class="connect">
            <div class="adress-head">
                Зв'язатись з нами
            </div>
            <div class="tell-num">
                <a href="tel:{{ $config->telephone }}">
                    <img src="img/phone-receiver.svg" alt="">{{ $config->telephone }}
                </a>
            </div>
            <div class="soc-media">
                <a href="{{ $config->facebook ?? "" }}" target="_blank" rel="noreferrer" aria-label="Контакти у facebook">
                    <img src="img/facebook-logo.svg" width="45px" height="45px" alt="facebook">
                </a>
                <a href="{{ $config->instagram ?? "" }}" target="_blank" rel="noreferrer" aria-label="Контакти у instagram">
                    <img src="img/instagram(white).svg" width="45px" height="45px" alt="instagram">
                </a>
                <a href="{{ $config->youtube ?? "" }}" target="_blank" rel="noreferrer" aria-label="Наші відео">
                    <img src="img/yout.png" width="63px" height="45px" alt="youtube">
                </a>
            </div>
        </div>
    </footer>
</div>