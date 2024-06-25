// Form validation
const checkoutButton = document.querySelector(".checkout-button");
checkoutButton.disabled = true;
const form = document.querySelector("#checkoutForm");

form.addEventListener("keyup", function () {
    let allFilled = true;

    for (let i = 0; i < form.elements.length; i++) {
        if (
            form.elements[i].type !== "submit" &&
            form.elements[i].value.length === 0
        ) {
            allFilled = false;
            break;
        }
    }

    if (allFilled) {
        checkoutButton.disabled = false;
        checkoutButton.classList.remove("disabled");
    } else {
        checkoutButton.disabled = true;
        checkoutButton.classList.add("disabled");
    }
});

checkoutButton.addEventListener("click", async function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const data = new URLSearchParams(formData);
    const objData = Object.fromEntries(data);

    // req token
    try {
        const response = await fetch("/php/placeOrder.php", {
            method: "POST",
            body: data,
        });
        const token = await response.text();
        window.snap.pay(token);
    } catch (err) {
        console.log(err.message);
    }
});

// pesan WA
const formatMessage = (obj) => {
    return `Data Customer
        Nama: ${obj.name}
        Alamat: ${obj.alamat}
        Kode Pos: ${obj.pos}
        No HP: ${obj.nohp}
    Data Pesanan
        Nama Produk: ${obj.produk}
        Jumlah: ${obj.qty}
        Harga: ${obj.harga}
        Total: ${obj.total}
    Terimakasih.
    `;
};

// document.addEventListener("DOMContentLoaded", function () {
//     const qtyInput = document.getElementById("qtyInput");
//     const priceText = document.getElementById("priceText").innerText;
//     const qtyFormField = document.getElementById("qty");
//     const hargaFormField = document.getElementById("harga");

//     // Set the initial values
//     qtyFormField.value = qtyInput.value;
//     hargaFormField.value = priceText;

//     // Update the qtyFormField value on qtyInput change
//     qtyInput.addEventListener("input", function () {
//         qtyFormField.value = qtyInput.value;
//     });
// });
