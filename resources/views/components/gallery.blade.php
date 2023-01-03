<div 
    id="lightgallery" 
    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4"
>
    @foreach ($photos as $photo)
        <a 
            class="w-full h-60" 
            href="{{ url('storage/files/'.$photo->file_name) }}"
        >
            <img 
                class="h-full w-full object-cover object-center" 
                src="{{ url('storage/files/'.$photo->file_name) }}" 
            />
        </a>
    @endforeach
</div>

<script>
    lightGallery(document.getElementById("lightgallery"), {
        animateThumb: false,
        flipHorizontal: false,
        flipVertical: false,
        rotateLeft: false,
        plugins: [
            lgZoom,
            lgThumbnail,
            lgFullscreen,
            lgShare,
            lgRotate,
            lgAutoplay,
        ],
        mobileSettings: {
            controls: false,
            showCloseIcon: false,
            download: false,
            rotate: false
        }
    });
</script>