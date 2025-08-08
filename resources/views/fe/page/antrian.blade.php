@extends('fe.plasma')
@section('contentantrian')
    <section class="max-h-[798px] overflow-x-hidden rounded " id="scrollBoxVertical">

        {{--  Header-table --}}
        <div class="grid grid-cols-3 sticky top-0 h-[124px]">
            <div class="col-span-2 bg-[#323949] flex items-center justify-center ">
                <h1 class="text-2xl text-white font-bold">NAMA PASIEN</h1>
            </div>
            <div class="bg-[#6796B4] flex items-center justify-center ">
                <h1 class="text-2xl text-white font-bold">NO. ANTRIAN</h1>
            </div>
        </div>


        {{-- content-table --}}
        @forelse ($antrianBelumDipanggil as $index => $antrianItem)
            <div class="grid grid-cols-3 auto-rows-[124px]">
                <div class="col-span-2 bg-[#6796B4] p-3 px-5 flex flex-col justify-between border-t-2">
                    <p class="text-3xl text-white font-bold">{{ $antrianItem->nama_pasien }}</p>
                    <div class='justify-between flex'>
                        <p class="text-2xl  text-white font-bold ">
                            {{ \Carbon\Carbon::parse(time: $antrianItem->created_at)->format(format: 'd-m-Y H:i') }}
                        </p>
                        <p class='text-2xl font-bold text-[#323949]'>
                            {{ $antrianItem->dipanggil ? 'Sudah' : 'Belum' }}</p>
                    </div>
                </div>
                <div class="bg-[#323949] flex items-center justify-center border-t-2 ">
                    <h1 class="text-6xl font-bold text-white">{{ $antrianItem->no_antrian }}</h1>
                </div>
            </div>
        @empty
            <div class="grid grid-cols-3 auto-rows-[124px]">
                <div class="col-span-2 bg-[#6796B4] p-3 px-5 flex flex-col justify-between border-t-2">
                    <p class="text-3xl text-white font-bold">-</p>
                    <div class='justify-between flex'>
                        <p class="text-xl font-bold text-white">-</p>
                        <p class='text-2xl font-bold text-[#323949]'>-</p>
                    </div>
                </div>
                <div class="bg-[#323949] flex items-center justify-center border-t-2 ">
                    <h1 class="text-6xl font-bold text-white">-</h1>
                </div>
            </div>
        @endforelse
    </section>
@endsection
