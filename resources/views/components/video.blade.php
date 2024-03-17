@props([
    'source'=>'https://cdn.devdojo.com/pines/videos/coast.mp4',
    'controls'=>true,
    'cover'=>false,


    ])


    <div x-data="{ playing: false,muted:false }" @click.outside="$refs.player.pause()" x-intersect:leave="$refs.player.pause()"  class=" m-auto h-full w-full relative">

        <video  x-ref="player" @play="playing = true" @pause="playing = false"
           class="h-full max-h-[800px]  m-auto   w-full {{$cover==true?'object-cover':''}}"  >
            <source src="{{$source}}" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>

        @if ($controls == true)


          <!-- Play button -->
        <div x-cloak x-show="!playing" @click="$refs.player.play()"
            class="absolute z-10 inset-0 flex items-center justify-center w-full h-full   cursor-pointer">

            <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M8.42737 3.41611C6.46665 2.24586 4.00008 3.67188 4.00007 5.9427L4 18.0572C3.99999 20.329 6.46837 21.7549 8.42907 20.5828L18.5698 14.5207C20.4775 13.3802 20.4766 10.6076 18.568 9.46853L8.42737 3.41611Z"
                    fill="currentColor" />
            </svg>
        </div>

        <!-- Pause button -->
        <div x-show="playing" @click="$refs.player.pause()"
            class="absolute z-10 inset-0 flex items-center   justify-center w-full h-full   cursor-pointer">

                {{-- Add class invisible to mimic instagram'play pause --}}
            <svg class="w-16 h-16 text-white invisible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M16 3C17.1046 3 18 3.89543 18 5V19C18 20.1046 17.1046 21 16 21C14.8954 21 14 20.1046 14 19V5C14 3.89543 14.8954 3 16 3ZM8 3C9.10457 3 10 3.89543 10 5V19C10 20.1046 9.10457 21 8 21C6.89543 21 6 20.1046 6 19V5C6 3.89543 6.89543 3 8 3Z"
                    fill="currentColor" />
            </svg>
        </div>

        {{-- Mute --}}
        <div  class="absolute z-[1000] bottom-2 right-2 m-4 bg-gray-900 text-white  rounded-lg p-1   cursor-pointer">

              <!-- Mute   -->
            <svg x-cloak x-show="!muted" @click="$refs.player.muted = true; muted = true" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM18.584 5.106a.75.75 0 011.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 11-1.06-1.06 8.25 8.25 0 000-11.668.75.75 0 010-1.06z" />
                <path d="M15.932 7.757a.75.75 0 011.061 0 6 6 0 010 8.486.75.75 0 01-1.06-1.061 4.5 4.5 0 000-6.364.75.75 0 010-1.06z" />
            </svg>

              <!-- Un Mute -->
            <svg x-show="muted" @click="$refs.player.muted = false; muted = false" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM17.78 9.22a.75.75 0 10-1.06 1.06L18.44 12l-1.72 1.72a.75.75 0 001.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L20.56 12l1.72-1.72a.75.75 0 00-1.06-1.06l-1.72 1.72-1.72-1.72z" />
            </svg>
        </div>
        @endif


    </div>

