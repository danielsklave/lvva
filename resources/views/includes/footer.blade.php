<!-- Footer -->


<div class="bg-gray-50">
    <div class="p-8 text-center space-y-4 container mx-auto">
        <h5 class="text-3xl font-bold">Mūsu sadarbības partneri</h5>
        <div class="justify-evenly items-center flex gap-4 sm:flex-row flex-col">
            <a href="http://lsvs.lv/" target="_blank">
                <img class="max-w-md max-h-40" src="{{ url('/images/lsvs_logo.png') }}" alt="">
            </a>
            <a href="https://athletics.lv/" target="_blank">
                <img class="max-w-md max-h-40 mix-blend-multiply" src="{{ url('/images/lvs_logo_1.jpg') }}" alt="">
            </a>
            <a href="https://world-masters-athletics.com/" target="_blank">
                <img class="max-w-md max-h-40" src="{{ url('/images/WMA.png') }}" alt="">
            </a>
            <a href="https://european-masters-athletics.org/" target="_blank">
                <img class="max-w-md max-h-40 mix-blend-multiply" src="{{ url('/images/EMA_3.png') }}" alt="">
            </a>
        </div>
    </div>
</div>

<div class="bg-blue-100">
    <div class="p-8 text-center space-y-4 container mx-auto">
        <h5 class="text-3xl font-bold">Mūsu atbalstītāji</h5>
        <div class="justify-evenly items-center flex gap-4 sm:flex-row flex-col">
            <a href="http://www.teamsport.lv" target="_blank">
                <img class="max-w-md max-h-40" src="{{ url('/images/nike.jpg') }}" alt="">
            </a>
            <a href="http://www.sportamuzejs.lv/index.php/lv/" target="_blank">
                <img class="max-w-md max-h-40 mix-blend-multiply" src="{{ url('/images/muzeja_logo.jpg') }}" alt="">
            </a>
        </div>
    </div>
</div>

<footer class="py-5 bg-sky-800 text-white font-medium">
    <div class="flex flex-col md:flex-row justify-center items-center gap-8">
        <a href="{{ route('about.contacts') }}">Kontakti</a> 
        <a href="http://www.lvva.lv/downloads/faili_21/privatuma_politika_lvva_22_01_2021.pdf">Privātuma politika</a>
    </div>
    <!-- /.container -->
</footer>