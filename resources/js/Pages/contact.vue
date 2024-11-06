<template>
  <Head title="contact" />
  <app-layout
    title="appdynamic"
    :services="service"
    :navItems="navItems"
    :settings="settings"
    :intro="intro"
  >
    <template #content>
      <div>
        <div
          v-if="cdone"
          :class="
            'alert text-white alert-dismissible fade show rounded-0 mb-0 text-lg-center ' +
            messageClass
          "
          role="alert"
        >
          <div class="container">
            <div class="alert-inner">
              <span :class="'badge text-uppercase rounded me-2 ' + messageClass"
                >Felicitation</span
              >
              {{ message }}
            </div>
            <!-- /.alert-inner -->
          </div>
          <!-- /.container -->
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
          ></button>
        </div>
        <section class="wrapper bg-light wrapper-border">
          <div class="container py-14 py-md-16">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
              <div class="col-lg-7">
                <figure>
                  <img
                    class="w-auto"
                    src="../../img/shape/undraw_landscape_photographer_re_bxdk.svg"
                    srcset="
                      ../../img/shape/undraw_landscape_photographer_re_bxdk.svg
                    "
                    alt=""
                  />
                </figure>
              </div>
              <!--/column -->
              <div class="col-lg-5">
                <h2
                  class="
                    fs-15
                    text-uppercase text-line text-primary text-center
                    mb-3
                    ttf
                  "
                >
                  Let’s Talk
                </h2>
                <h3 class="display-5 mb-7 tts">
                  Let's make something great together. We are trusted by over
                  100+ clients. Join them by using our services and grow your
                  business.
                </h3>
                <div class="d-flex flex-row">
                  <div>
                    <div class="icon text-primary fs-28 me-4 mt-n1">
                      <i class="uil uil-location-pin-alt"></i>
                    </div>
                  </div>
                  <div>
                    <h5 class="mb-1">Address</h5>
                    <address>{{ settings.adress }}</address>
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div>
                    <div class="icon text-primary fs-28 me-4 mt-n1">
                      <i class="uil uil-phone-volume"></i>
                    </div>
                  </div>
                  <div>
                    <h5 class="mb-1">Phone</h5>
                    <p>{{ settings.phone }}</p>
                  </div>
                </div>
                <div class="d-flex flex-row">
                  <div>
                    <div class="icon text-primary fs-28 me-4 mt-n1">
                      <i class="uil uil-envelope"></i>
                    </div>
                  </div>
                  <div>
                    <h5 class="mb-1">E-mail</h5>
                    <p class="mb-0">
                      <a :href="'mailto:' + settings.email" class="link-body">{{
                        settings.email
                      }}</a>
                    </p>
                  </div>
                </div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!-- /.container -->
        </section>
        <!-- /section -->
        <section class="wrapper bg-light wrapper-border">
          <div class="container py-14 py-md-16">
            <div class="row">
              <div class="col-xl-12 mx-auto">
                <div class="row gy-10 gx-lg-8 gx-xl-12">
                  <div class="col-lg-12">
                    <form class="contact-form" @submit.prevent="submit">
                      <div class="messages"></div>
                      <div class="controls">
                        <div class="row gx-4">
                          <div class="col-md-6">
                            <div class="form-label-group mb-4">
                              <input
                                id="form_name"
                                v-model="contactForm.firstname"
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Jane"
                                required="required"
                              />
                              <label for="form_name">First name *</label>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <!-- /column -->
                          <div class="col-md-6">
                            <div class="form-label-group mb-4">
                              <input
                                v-model="contactForm.lastname"
                                id="form_lastname"
                                type="text"
                                name="surname"
                                class="form-control"
                                placeholder="Doe"
                                required="required"
                              />
                              <label for="form_lastname">Last name *</label>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <!-- /column -->
                          <div class="col-md-6">
                            <div class="form-label-group mb-4">
                              <input
                                id="form_email"
                                v-model="contactForm.email"
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="jane.doe@example.com"
                                required="required"
                              />
                              <label for="form_email">Email *</label>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <!-- /column -->
                          <div class="col-md-6">
                            <div class="form-label-group mb-4">
                              <input
                                id="form_phone"
                                v-model="contactForm.phone"
                                type="tel"
                                name="phone"
                                class="form-control"
                                placeholder="Your phone number"
                              />
                              <label for="form_phone">Phone </label>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <!-- /column -->
                          <div class="col-12">
                            <div class="form-label-group mb-4">
                              <textarea
                                id="form_message"
                                v-model="contactForm.message"
                                name="message"
                                class="form-control"
                                placeholder="Your message"
                                rows="5"
                                required="required"
                                data-error="Message is required."
                              ></textarea>
                              <label for="form_message">Message *</label>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <!-- /column -->
                          <div class="col-12">
                            <input
                              type="submit"
                              class="btn btn-primary rounded-pill btn-send mb-3"
                              value="Send message"
                            />
                            <p class="text-muted">
                              <strong>*</strong>These fields are required.
                            </p>
                          </div>
                          <!-- /column -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.controls -->
                    </form>
                    <!-- /form -->
                  </div>
                </div>
                <!--/.row -->
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container -->
        </section>
        <!-- /section -->
      </div>
    </template>
  </app-layout>
</template>


<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayoutVue.vue";
import vintro from "@/Pages/content/includes/intro.vue";
import vservices from "@/Pages/content/includes/ourServices.vue";
import rowSectionData from "@/Pages/content/includes/rowSectionData.vue";
import ourCustomer from "@/Pages/content/includes/ourCustomer.vue";
import ourProject from "@/Pages/content/includes/projects.vue";
import sintroVue from "./content/includes/sintro.vue";
import factVue from "./content/includes/fact.vue";
import elearningVue from "./content/includes/elearning.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    AppLayout,
    vintro,
    vservices,
    rowSectionData,
    ourCustomer,
    ourProject,
    sintroVue,
    factVue,
    elearningVue,
  },

  props: ["navItems", "settings", "asset"],
  data() {
    return {
      cdone: false,
      message: "",
      messageClass: "bg-primary",
      contactForm: this.$inertia.form({
        firstname: null,
        lastname: null,
        email: null,
        message: null,
        phone: null,
      }),
    };
  },
  methods: {
    submit() {
      this.contactForm.post(route("postcontact"), {
        onSuccess: () => {
          this.cdone = true;
          this.messageClass = "bg-success";
          this.message =
            "Votre message a été envoyé, vous recevrez un retour dès que possible.";
          this.contactForm.reset();
        },
      });
    },
  },
});
</script>
