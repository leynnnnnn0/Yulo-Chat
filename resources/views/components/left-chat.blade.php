<div class="flex w-full">
    <div class="flex gap-3 w-2/3">
        <section>
            <x-profile/>
        </section>
        <section class="bg-primary p-2 rounded-lg h-fit">
            <x-p>{{$slot}}</x-p>
        </section>
    </div>
</div>
