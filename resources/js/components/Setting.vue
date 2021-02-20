<template>
  <div class="container">
    <div class="row justify-content-center mt-3">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Site Settings</div>
          <form>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.siteTitle"
                      placeholder="Site Name"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea
                      type="text"
                      v-model="form.siteDescription"
                      placeholder="Site Description"
                      class="form-control"
                      rows="2"
                      style="resize:none;"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.mobile"
                      class="form-control"
                      placeholder="Mobile no."
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.telephone"
                      class="form-control"
                      placeholder="Telephone"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="email"
                      v-model="form.email"
                      class="form-control"
                      placeholder="Email"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea
                      type="text"
                      v-model="form.address"
                      placeholder="Office Address"
                      class="form-control"
                      rows="2"
                      style="resize:none;"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.facebook"
                      class="form-control"
                      placeholder="Facebook Profile Link"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.twitter"
                      class="form-control"
                      placeholder="Twitter Profile Link"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.insta"
                      class="form-control"
                      placeholder="Instagram Profile Link"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.youtube"
                      class="form-control"
                      placeholder="Youtube Profile Link"
                    />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input
                      type="text"
                      v-model="form.linkedin"
                      class="form-control"
                      placeholder="Linkedin Profile Link"
                    />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea
                      class="form-control"
                      v-model="form.header"
                      rows="8"
                      style="resize:none;"
                      placeholder="Additional Meta Tags (Bing verify, Yandex verify)"
                    ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea
                      class="form-control"
                      v-model="form.footer"
                      rows="8"
                      style="resize:none;"
                      placeholder="Additional Scripts (Google Analytics, Chat Scripts)"
                    ></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <button
                    v-show="editmode"
                    class="btn btn-success btn-block"
                    @click.prevent="updateInfo"
                    type="submit"
                  >Update</button>
                  <button
                    v-show="!editmode"
                    class="btn btn-success btn-block"
                    @click.prevent="save"
                    type="submit"
                  >Create</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      settings: {},
      form: new Form({
        id: "",
        siteTitle: "",
        siteDescription: "",
        mobile: "",
        telephone: "",
        email: "",
        address: "",
        facebook: "",
        twitter: "",
        youtube: "",
        insta: "",
        linkedin: "",
        header: "",
        footer: ""
      })
    };
  },
  methods: {
    save() {
      this.form
        .post("api/settings")
        .then(() => {
          Fire.$emit("AfterCreate");
        })
        .catch(error => {
        });
    },
    initialLoad() {
      axios.get("api/settings").then(({ data }) => this.form.fill(data));
    }
  },
  created() {
    this.initialLoad();
    Fire.$on("AfterCreate", () => {
      this.initialLoad();
    });
  }
};
</script>