<div style="text-align: center">

    <button wire:click='increment'>+ เพิ่ม</button>

    <form action="">
        <input type="text" value="{{ $counter }}">
    </form>
    
    <button wire:click='decrement'>- ลด</button>
    <button wire:click='resetCounter'>Reset</button>

</div>
