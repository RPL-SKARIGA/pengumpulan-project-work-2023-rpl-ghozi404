function validateForm() {

    var selectedCategory = document.querySelector('[name="selectedCategory"]').value;

    if (selectedCategory === 'Processor') {

        var brand = document.querySelector('[name="Brand"]').value;
        var segment = document.querySelector('[name="Segment"]').value;
        var gen = document.querySelector('[name="cpu-gen"]').value;
        var frequency = document.querySelector('[name="freq"]').value;
        var core = document.querySelector('[name="core"]').value;
        var threads = document.querySelector('[name="threads"]').value;
        var tdp = document.querySelector('[name="tdp"]').value;
        var desc = document.querySelector('[name="deskripsi"]').value;
        
        if (brand === '' || segment === '' || frequency === '' || core === '' || threads === '' || tdp === '' || gen === '' || desc === '') {
            alert('Tolong lengkapi data.');
            return false;
        }
    } else if (selectedCategory === 'Motherboard') {

        var nama = document.querySelector('[name="nama"]').value;
        var socket = document.querySelector('[name="socket"]').value;
        var maxMemory = document.querySelector('[name="max-memory"]').value;
        var slotMemory = document.querySelector('[name="memory-slot"]').value;
        var desc2 = document.querySelector('[name="deskripsi2"]').value;

        if (nama === '' || socket === '' || maxMemory === '' || slotMemory === '' || desc2 === '') {
            alert('Tolong lengkapi data.');
            return false;
        }
    } else if (selectedCategory === 'VGA Card'){
        var chipset = document.querySelector('[name="chipset"]').value;
        var spek = document.querySelector('[name="spek"]').value;
        var desc3 = document.querySelector('[name="deskripsi3"]').value;

        if(chipset === '' || spek === '' || desc3 === ''){
            alert('Tolong lengkapi data');
            return false;
        }
    } else if (selectedCategory === 'Power Supply'){
        var psuName = document.querySelector('[name="psuName"]').value;
        var rating = document.querySelector('[name="rating"]').value;
        var watt = document.querySelector('[name="wattage"]').value;
        var desc4 = document.querySelector('[name="deskripsi4"]').value;

        if(psuName === '' || rating === '' || watt === '' || desc4 === ''){
            alert('Tolong lengkapi data');
            return false;
        }
    } else if (selectedCategory === 'Storage'){
        var romName = document.querySelector('[name="romName"]').value;
        var romType = document.querySelector('[name="romType"]').value;
        var capacity = document.querySelector('[name="capacity"]').value;
        var desc5 = document.querySelector('[name="deskripsi5"]').value;

        if(romName === '' || romType === '' || capacity === '' || desc5 === ''){
            alert('Tolong lengkapi data');
            return false;
        }
    } else if (selectedCategory === 'Memory'){
        var ramName = document.querySelector('[name="ramName"]').value;
        var ramType = document.querySelector('[name="ramType"]').value;
        var speed = document.querySelector('[name="speed"]').value;
        var size = document.querySelector('[name="size"]').value;
        var desc6 = document.querySelector('[name="deskripsi6"]').value;

        if(ramName === '' || ramType === '' || speed === '' || size === '' || desc6 === ''){
            alert('Tolong lengkapi data');
            return false;
        }
    }

    return true;
}
