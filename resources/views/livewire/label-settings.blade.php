<div>
    <style>
    *{
        margin: 0px;
    }

    .mb{
        padding-bottom: 5px;
    }

    p{
        margin: 0px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
        line-height: 10px;
        font-size: 12px;
    }

    .body p{
        font-size: {{$bodyTextSize}}px;
    }
    .inner{
        width: 100%;
        height: 100%;
    }

    .header-text{
        font-size: 8px;
    }

    .label{
        border: 1px solid black;
        border-radius: 4px;
        width: {{ $paperWidth ? $paperWidth : $label->paper_width }}mm ;
        height: {{ $paperHeight ? $paperHeight : $label->paper_height }}mm ;
        padding: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header{
       height: {{ $headerHeight }}mm;
    }
    .header p{
        font-size: {{ $headerTextSize }}px;
    }

    .d-flex-between{
        display: flex;
        justify-content: space-between;
    }

    @page {
            size: {{$paperWidth}}mm {{ $paperHeight }}mm;
        }

    @media all{
        .pageBreak {
            display: none;
        }
    }

    @media print{
        body * {
            display: none !important;
        }
        .printable {
            display: block !important;
        }
        .inner{
            border: none;
        }
        .label{
            border: none;
        }
    }
    </style>

    <form wire:submit="submit">
        <!-- Pjesa per me editu madhesin e letres -->
        <div class="row">
            <div class="col">
                <div class="row border rounded p-3">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center pb-3">Letra</h3>
                    <div class="col">
                        <label for="name" >name</label>
                        <input type="text" wire:model.live.debounce.250ms="name" id="paperInput" class="form-control rounded" name="name" placeholder="Emri">
                    </div>
                    <div class="col">
                        <label for="paper_width" >Gjerësia (mm)</label>
                        <input type="number" wire:model.live.debounce.250ms="paperWidth" id="paperInput" class="form-control rounded" name="paper_width" placeholder="{{ $label->paper_width }}mm" value="{{ $label->paper_width }}">
                    </div>
                    <div class="col">
                        <label for="paper_height">Lartësia (mm)</label>
                        <input type="number" wire:model.live.debounce.250ms="paperHeight" id="paperInput" class="form-control rounded" name="paper_height" placeholder="{{ $label->paper_height }}mm" value="{{ $label->paper_height }}">
                    </div>
                </div>
            </div>
        <!-- Pjesa per me editu madhsin hapsires mbrenda letres -->
            <div class="col">
                <div class="row border rounded p-3">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center pb-3">Përmbajtja</h3>
                    <div class="col">
                        <label for="content_margin" >Margjina (mm)</label>
                        <input type="number" wire:model.live.debounce.250ms="contentMargin" id="contentMarginInput" class="form-control rounded" name="content_margin" placeholder="{{ $label->content_margin }}mm" value="{{ $label->content_margin }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Pjesa per me editu headerin -->
            <div class="col">
                <div class="row border rounded p-3">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center pb-3">Headeri</h3>
                    <!-- Editimi madhesis se tekstit te headerit -->
                    <div class="col">
                        <label for="header_text_size" >Madhësia tekstit (px)</label>
                        <input type="number" wire:model.live.debounce.250ms="headerTextSize" id="headerTextSizeInput" class="form-control rounded" name="header_text_size" placeholder="{{ $label->header_text_size }}mm" value="{{ $label->header_text_size }}">
                    </div>
                    <!-- Editimi lartesis se headerit -->
                    <div class="col">
                        <label for="header_height" >Lartësia headerit (mm)</label>
                        <input type="number" wire:model.live.debounce.250ms="headerHeight" id="headerTextSizeInput" class="form-control rounded" name="header_height" placeholder=" {{ $label->header_height }} "  value="{{ $label->header_height }}">
                    </div>
                </div>
            </div>
            <!-- Pjesa per me editu bodyn -->
            <div class="col">
                <div class="row border rounded p-3">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center pb-3">Body</h3>
                    <!-- Editimi madhesis se tekstit te Bodyt -->
                    <div class="col">
                        <label for="body_text_size" >Teksti (px)</label>
                        <input type="number" wire:model.live.debounce.250ms="bodyTextSize" id="bodyTextAreaInput" class="form-control rounded" name="body_text_size" placeholder="{{ $label->body_text_size }}mm" value="{{ $label->body_text_size }}">
                    </div>
                    <!-- Editimi lartesis se headerit -->
                    <div class="col">
                        <label for="body_text_area_width" >Gjerësia (mm)</label>
                        <input type="number" wire:model.live.debounce.250ms="bodyTextAreaWidth" id="bodyTextAreaInput" class="form-control rounded" name="body_text_area_width" placeholder=" {{ $label->body_text_area_width }} "  value="{{ $label->body_text_area_width }}">
                    </div>
                    <div class="col">
                        <label for="body_text_margin" >Margjina (px)</label>
                        <input type="number" wire:model.live.debounce.250ms="bodyTextMargin" id="bodyTextAreaInput" class="form-control rounded" name="body_text_margin" placeholder=" {{ $label->body_text_area_margin }} "  value="{{ $label->body_text_margin }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Pjesa per me editu headerin -->
            <div class="col">
                <div class="row border rounded p-3">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center pb-3">QR CODE</h3>
                    <!-- Editimi madhesis se tekstit te headerit -->
                    <div class="col">
                        <label for="qrcode_size" >QR Code</label>
                        <input type="number" wire:model.live.debounce.250ms="qrcodeSize" id="qrcodeInput" step="0.1" class="form-control rounded" name="qrcode_size" placeholder="{{ $label->qrcode_size }}mm" value="{{ $label->qrcode_size }}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-success">Ruaj</button>
    </form>
    <!-- Labeli per preview -->
    <b class="mt-4 d-block text-center mb-2">Live preview</b>
    <div class="d-flex justify-content-center">
        <div class="label printable" id="paper">
            <div class="inner" id="inner" style="width: {{ $paperWidth ? $paperWidth - $contentMargin : 0 }}mm; height: {{ $paperHeight ? $paperHeight - $contentMargin : 0 }}mm">
                <div class="header d-flex-between" id="header">
                    <p>02/09/2024</p><br>
                    <p>Emri Puntorit</p>
                </div>
                <div class="body d-flex-between" >
                    <div style="width: {{ $bodyTextAreaWidth }}mm;" id="body">
                        <p ><i class="bi bi-person-fill"></i> : Emri Klientit</p>
                        <p><i class="bi bi-lock-fill"></i> : 0000</p>
                        <p style="margin-bottom: {{ $bodyTextMargin }}px;"><i class="bi bi-telephone-fill"></i> : 044123123</p>
                        <p><i class="bi bi-clock-fill"></i> : 16:00:00</p>
                    </div>
                    {!! DNS2D::getBarcodeSVG("http://127.0.0.1:8000/jobs/47/edit", 'QRCODE', $qrcodeSize, $qrcodeSize) !!}
                </div>
            </div>
        </div>
        
    </div><button class="btn btn-primary btn-sm" onclick="window.print()" >Print test</button>

    <script>
        //letra
        const paper = document.getElementById('paper');
        //inner
        const inner = document.getElementById('inner');
        //header text size
        const header = document.getElementById('header');
        //body label
        const body = document.getElementById('body')


        //funksioni per shtimin e borderit per leter
        function addRedBorder(element) {
            element.style.border="1px solid red";
        }
         //funksioni per heqjen e borderit per leter
        function removeRedBorder(element) {
            element.style.border="";
        }

        //inputi per leter
        const paperInput = document.querySelectorAll('#paperInput');
        paperInput.forEach(function (input) {
                input.addEventListener("focus", () =>addRedBorder(paper));
                input.addEventListener("blur", () => removeRedBorder(paper));
            });
        
        //inputi per inner
        const innerInput = document.querySelectorAll('#contentMarginInput');
        innerInput.forEach(function (input) {
                input.addEventListener("focus", () => addRedBorder(inner));
                input.addEventListener("blur", () => removeRedBorder(inner));
            });
        //inputi per header text size
        const headerTextSizeInput = document.querySelectorAll('#headerTextSizeInput');
        headerTextSizeInput.forEach(function (input) {
                input.addEventListener("focus", () => addRedBorder(header));
                input.addEventListener("blur", () => removeRedBorder(header));
            });
        //inputi per body
        const bodyTextAreaInput = document.querySelectorAll('#bodyTextAreaInput');
        bodyTextAreaInput.forEach(function (input) {
                input.addEventListener("focus", () => addRedBorder(body));
                input.addEventListener("blur", () => removeRedBorder(body));
            });
    </script>
</div>
