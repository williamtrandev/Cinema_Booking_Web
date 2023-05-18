<footer class="text-center text-lg-start text-muted">
    <div class="container" style="color: var(--text-color)">
        <section class="p-3">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i><span style="color: var(--text-color)">WillCinema</span>
                        </h6>
                        <p>
                            Web đặt vé xem phim uy tín hàng đầu Việt
                            Nam
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Hệ thống rạp
                        </h6>

                        <div class="htr">
                            <p>
                                <a href="#!" class="text-reset text-decoration-none">WillCinema Quận 5</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset text-decoration-none">WillCinema Quận 6</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset text-decoration-none">WillCinema Quận 7</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset text-decoration-none">WillCinema Quận 8</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Chính sách và quy định
                        </h6>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none">Quy định chung</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none">Điều khoản giao dịch</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Liên hệ
                        </h6>
                        <p>
                            <i class="fas fa-home me-3"></i>
                            Nguyễn Hữu Thọ, Quận 7, TP.HCM
                        </p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            willcinema@gmail.com
                        </p>
                        <p>
                            <i class="fas fa-phone me-3"></i>
                            + 01 234 567 88
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4">
            © 2023 Copyright: WillCinema
        </div>
    </div>
</footer>
<script>
    fetch(`<?php echo _WEB_ROOT ?>/theater/getAll`)
        .then(res => res.json())
        .then(data => {
            $(".htr").children().remove();
            let p = "";
            data.forEach(element => {
                p += `<p>
                            <a href="#!" class="text-reset text-decoration-none">${element.name}</a>
                    </p>`;
            });
            $(".htr").append(p);
        })
        .catch(err => console.log(err));
</script>