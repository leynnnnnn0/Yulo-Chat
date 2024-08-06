@props(['icon'])
<div>
    <i {{ $attributes->merge(["class" => "$icon flex items-center justify-center h-10 w-10 text-xl text-white/50 bg-white/10 rounded-full text-center"]) }}></i>
</div>
