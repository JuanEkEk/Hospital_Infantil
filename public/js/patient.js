var route = document.querySelector("[name=route]").value;
var UrlPatient = route + "/apiPatient";
// PDF
var UrlPDF = route + "/report";

new Vue({
    http: {
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector("#token")
                .getAttribute("value"),
        },
    },

    el: "#patient",

    data: {
        patients: [],

        full_name: "",
        age: "",
        sex: "",
        birth_date: "",
        inscription_date: "",
        origin_city: "",
        origin_hospital: "",
        tutor: "",
        tutor_telephone: "",

        id: "",
        id_patient: "",

        // validation
        errors: [],

        // search
        search: "",
    },

    mounted: function () {
        this.getPatient();
    },

    methods: {
        showModal: function () {
            $("#add_patient").modal("show");
        },

        getPatient: function () {
            this.$http.get(UrlPatient).then(function (json) {
                this.patients = json.data;
            });
        },

        showPatient: function (id) {
            this.$http.get(UrlPatient + "/" + id).then(function (json) {
                this.full_name = json.data.full_name;
                this.age = json.data.age;
                this.sex = json.data.sex;
                this.birth_date = json.data.birth_date;
                this.inscription_date = json.data.inscription_date;
                this.origin_city = json.data.origin_city;
                this.origin_hospital = json.data.origin_hospital;
                this.tutor = json.data.tutor;
                this.tutor_telephone = json.data.tutor_telephone;
            });

            $("#show_patient").modal("show");
        },

        addPatient: function () {
            var p = {
                full_name: this.full_name,
                age: this.age,
                sex: this.sex,
                birth_date: this.birth_date,
                inscription_date: this.inscription_date,
                origin_city: this.origin_city,
                origin_hospital: this.origin_hospital,
                tutor: this.tutor,
                tutor_telephone: this.tutor_telephone,
            };
            this.$http
                .post(UrlPatient, p)
                .then(function () {
                    $("#add_patient").modal("hide");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Guardado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.getPatient();
                    this.clean();
                })
                .catch(function (error) {
                    if (error.status === 422) {
                        this.errors = error.data.errors;
                    }
                });
        },

        editPatient: function (id) {
            this.id_patient = id;
            this.$http.get(UrlPatient + "/" + id).then(function (json) {
                this.full_name = json.data.full_name;
                this.age = json.data.age;
                this.sex = json.data.sex;
                this.birth_date = json.data.birth_date;
                this.inscription_date = json.data.inscription_date;
                this.origin_city = json.data.origin_city;
                this.origin_hospital = json.data.origin_hospital;
                this.tutor = json.data.tutor;
                this.tutor_telephone = json.data.tutor_telephone;
            });
            $("#edit_patient").modal("show");
        },

        updatePatient: function () {
            var p = {
                full_name: this.full_name,
                age: this.age,
                sex: this.sex,
                birth_date: this.birth_date,
                inscription_date: this.inscription_date,
                origin_city: this.origin_city,
                origin_hospital: this.origin_hospital,
                tutor: this.tutor,
                tutor_telephone: this.tutor_telephone,
            };
            this.$http
                .patch(UrlPatient + "/" + this.id_patient, p)
                .then(function () {
                    $("#edit_patient").modal("hide");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Actualizado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.getPatient();
                    this.clean();
                })
                .catch(function (error) {
                    if (error.status === 422) {
                        this.errors = error.data.errors;
                    }
                });
        },

        deletePatient: function (id) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir este cambio!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrar",
                cancelButtonText: "No, cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$http
                        .delete(UrlPatient + "/" + id)
                        .then(function () {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "¡Eliminado exitosamente!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            this.getPatient();
                        })
                        .catch(function (json) {});
                }
            });
        },

        clean: function () {
            this.errors = "";
            this.id = "";
            this.full_name = "";
            this.age = "";
            this.sex = "";
            this.birth_date = "";
            this.inscription_date = "";
            this.origin_city = "";
            this.origin_hospital = "";
            this.tutor = "";
            this.tutor_telephone = "";
        },

        showPDF: function (id) {
            var url = UrlPDF + "?id=" + id;
            window.open(url, this.id, "_blank");
        },
    },

    // filter
    computed: {
        patientFilter: function () {
            return this.patients.filter((p) => {
                return p.full_name
                    .toLowerCase()
                    .match(this.search.toLowerCase().trim());
            });
        },
    },
});
