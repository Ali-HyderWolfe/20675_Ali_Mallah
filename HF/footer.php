
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    $('#myTable').DataTable({
    "paging": true,  
    "searching": true, 
    "ordering": true 
});


     $(document).ready(function() {
        let attachmentCount = 0;

        $('#add-attachment').on('click', function() {
            attachmentCount++;
            
            let newAttachment = `
                <div class="attachment-group mb-3" id="attachment-${attachmentCount}">
                    <label for="attachment-title-${attachmentCount}" class="form-label">Attachment Title</label>
                    <input type="text" class="form-control mb-2" id="attachment-title-${attachmentCount}" name="attachment_titles[]" placeholder="Enter attachment title" required>
                    
                    <label for="attachment-file-${attachmentCount}" class="form-label">Upload File</label>
                    <input type="file" class="form-control-file" id="attachment-file-${attachmentCount}" name="attachment_files[]" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.zip" required>
                    
                    <small class="form-text text-muted">Allowed file types: DOC, Excel, PPT, PDF</small>
                </div>
            `;
            
            $('#attachment-container').append(newAttachment);
        });
    });

</script>



<!-- Footer -->
<footer class="text-center mt-5 bg-dark text-light">
    <div class="row py-4">
        <div class="col-sm-4">
            <h3 class="text-primary">Services</h3>
            <ul class="list-unstyled">
                <li><a href="index.php" class="text-light">Home</a></li>
                <li><a href="about.php" class="text-light">About Us</a></li>
                <li><a href="feedback.php" class="text-light">Feedback</a></li>
                <li><a href="logout.php" class="text-light">Logout</a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <h3 class="text-primary">Partners</h3>
            <ul class="list-unstyled">
                <li><a href="#" class="text-light">Marvel Comic Universe</a></li>
                <li><a href="#" class="text-light">DC</a></li>
                <li><a href="#" class="text-light">Hidaya Trust</a></li>
                <li><a href="#" class="text-light">Andrew Tate</a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <h3 class="text-primary">Social Media</h3>
            <ul class="list-unstyled">
                <li><a href="https://www.facebook.com" class="text-light">Facebook</a></li>
                <li><a href="https://www.instagram.com" class="text-light">Instagram</a></li>
                <li><a href="https://www.youtube.com" class="text-light">YouTube</a></li>
                <li><a href="https://www.twitter.com" class="text-light">Twitter</a></li>
            </ul>
        </div>
    </div>
    <div class="py-3">
        <small>&copy; 2024 Marvel Blog. All Rights Reserved.</small>
    </div>
</footer>
<!-- Footer -->

</body>
</html>