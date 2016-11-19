$(function() {
    
    estimate();

    // on click
    $("input").click(estimate);

    // estimate = function() {
    function estimate() {
        // alert("debug");
        // デフォルトは1万円
        var yen = 10000;

        // course
        $("input[name='course']").each(function() {
            if (this.value == "omakase" && this.checked) {
                // do nothing
            } else if (this.value == "custom" && this.checked) {
                yen *= 2;
            }
        });

        // pages
        $("input[name='pages']").each(function() {
            if (this.value == "pages_1" && this.checked) {
                // do nothing
            } else if (this.value == "pages_2" && this.checked) {
                yen *= 2;
            } else if (this.value == "pages_3" && this.checked) {
                yen *= 4;
            }
        });

        // dynstat
        $("input[name='dynstat']").each(function() {
            if (this.value == "static" && this.checked) {
                // do nothing
            } else if (this.value == "dynamic" && this.checked) {
                // yen *= 2;
                yen += 10000;
            } else if (this.value == "other" && this.checked) {
                // yen *= 1.5;
                yen += 5000;
            }
        });

        // photos
        $("input[name='photos']").each(function() {
            if (this.value == "customer" && this.checked) {
                // do nothing
            } else if (this.value == "me" && this.checked) {
                yen += 5000;
            }
        });

        // server
        $("input[name='server']").each(function() {
            if (this.value == "customer" && this.checked) {
                // do nothing
            } else if (this.value == "me" && this.checked) {
                yen += 10000;
            } else if (this.value == "other" && this.checked) {
                yen += 5000;
            }
        });


        yen -= 200;

        var formated_yen = Number(yen).toLocaleString('ja-JP', { style: 'currency', currency: 'JPY' });
        $("div#easy-estimate-yen").html(formated_yen + "- （税抜き）価格は目安です。");
    };
});
