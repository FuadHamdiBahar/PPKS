$("#id_sms").change(function () {
    var prodiID = $(this).val();
    console.log(prodiID);
    if (prodiID) {
        $.ajax({
            type: 'GET',
            url: "{{ url('getKurikulum') }}?id_sms=" + prodiID,
            success: function (res) {
                if (res) {
                    $("#id_kurikulum").empty();
                    $("#id_kurikulum").append(
                        "<option selected disabled>Pilih Kurikulum</option>");
                    $("#id_matkul").empty();
                    $("#id_matkul").append(
                        "<option selected disabled>Pilih Mata Kuliah</option>");
                    $.each(res, function (key, value) {
                        $("#id_kurikulum").append("<option value='" + key + "'>" +
                            value + "</option>");
                    });
                } else {
                    $("#id_kurikulum").empty();
                }
            }
        })
    } else {
        $("#id_kurikulum").empty();
    }
});

$("#id_kurikulum").change(function () {
    var matkulID = $(this).val();
    console.log(matkulID);
    if (matkulID) {
        $.ajax({
            type: 'GET',
            url: "{{ url('getMataKuliah') }}?id_kurikulum_sp=" + matkulID,
            success: function (res) {
                if (res) {
                    $("#id_matkul").empty();
                    $("#id_matkul").append(
                        "<option selected disabled>Pilih Mata Kuliah</option>");
                    $.each(res, function (key, value) {
                        $("#id_matkul").append("<option value='" + key + "'>" +
                            value + "</option>");
                    });
                } else {
                    $("#id_matkul").empty();
                }
            }
        })
    } else {
        $("#id_matkul").empty();
    }
});