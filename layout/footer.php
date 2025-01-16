</div>
<div id="deleteModal" class="modal fade modal-md">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"><h5>Are you Sure?</h5></div>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Do you wanna delete?
            </div>
            <div class="modal-footer">
                <button id="confirmDelete" class="btn btn-danger">Delete</button>
                <button  class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let deleteSelect = $(".deleteSelect");
        let deleteKey =undefined;


        deleteSelect.on("click",function(e){
            deleteKey = e.currentTarget.getAttribute("data-value");
        })
        $("#confirmDelete").on("click",()=>location.replace("?deleteId="+deleteKey));
    </script>

</body>
</html>