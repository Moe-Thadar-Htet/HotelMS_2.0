<!-- <script src="../asset/js2/main.js"></script> -->

<script>
    let roomBtn = document.querySelectorAll(".room-btn");
    let roomIdValue =document.querySelectorAll(".roomIdValue");

    for (let i = 0; i < roomBtn.length; i++) {
        const element = roomBtn[i];
        element.addEventListener("click", function () {
            let roomNumbers = document.querySelectorAll(".room-no-value");
            roomNumbers.forEach(el => {
                el.innerHTML = element.getAttribute("data-value");
                roomIdValue.forEach(elem=>{
                    elem.value = element.getAttribute("data-id")
                    localStorage.setItem("roomId",element.getAttribute("data-id"));
                })
            });
        })
    }

    let roomId = localStorage.getItem("roomId");
    if(roomId){
        let roomIdValue =document.querySelectorAll(".roomIdValue");
        roomIdValue.forEach(elem=>{
            elem.value = roomId
        })
    }
    
</script>

<script>
    const today = new Date().toISOString().split('T')[0];

    const getTomorrow = () => {
        const tomorrowDate = new Date();
        tomorrowDate.setDate(tomorrowDate.getDate() + 1);
        return tomorrowDate.toISOString().split('T')[0];
    };

    const tomorrow = getTomorrow();

    document.getElementById('checkin').setAttribute('min', today); // Today for check-in
    document.getElementById('checkout').setAttribute('min', tomorrow); // Tomorrow for check-out

    const checkinField = document.getElementById('checkin');
    const checkoutField = document.getElementById('checkout');

    checkinField.addEventListener('change', function () {
        const checkinDate = checkinField.value;

        const newMinCheckoutDate = new Date(checkinDate);
        newMinCheckoutDate.setDate(newMinCheckoutDate.getDate() + 1);
        checkoutField.setAttribute('min', newMinCheckoutDate.toISOString().split('T')[0]);
    });
    document.getElementById('checkin2').setAttribute('min', today); // Today for check-in
    document.getElementById('checkout2').setAttribute('min', tomorrow); // Tomorrow for check-out

    const checkinField2 = document.getElementById('checkin2');
    const checkoutField2 = document.getElementById('checkout2');

    checkinField.addEventListener('change', function () {
        const checkinDate2 = checkinField2.value;

        const newMinCheckoutDate2 = new Date(checkinDate2);
        newMinCheckoutDate2.setDate(newMinCheckoutDate2.getDate() + 1);
        checkoutField2.setAttribute('min', newMinCheckoutDate2.toISOString().split('T')[0]);
    });
</script>
</body>

</html>