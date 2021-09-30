<template>
    <main>
        <div class="rui-page-preloader" role="status">
            <div class="rui-page-preloader-inner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="rui-main" v-if="!isAuth">
            <router-view></router-view>
        </div>
        <left-sidebar v-if="isAuth"/>
        <div class="rui-yaybar-bg" v-if="isAuth"></div>
        <new-navbar v-if="isAuth"/>
        <div class="rui-navbar-bg" v-if="isAuth"></div>
        <div class="rui-page content-wrap" v-if="isAuth">
            <router-view></router-view>
            <new-footer/>
        </div>
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
            v-if="isAuth"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h2" id="exampleModalPopupLabel">
                            Modal title
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span
                                data-feather="x"
                                class="rui-icon rui-icon-stroke-1_5"
                            ></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mnb-2">
                            I likeness fly one she'd won't winged Midst divide.
                            Their second stars, be their. Make moving. Great
                            saying fowl, heaven greater moving tree Multiply
                            midst blessed was there, days days they're a tree
                            dry let which they're.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-brand">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="rui-popup rui-popup-search container" id="search" v-if="isAuth">
            <div class="rui-search">
                <div class="rui-search-head">
                    <form action="#">
                        <div class="input-group">
                            <input
                                type="search"
                                class="form-control form-control-clean order-12"
                                placeholder="Type to search..."
                            />
                            <div class="input-group-prepend mnl-3 order-1">
                                <button
                                    type="button"
                                    class="btn btn-clean btn-uniform btn-grey-5 mb-0 mnl-10"
                                >
                                    <span
                                        data-feather="search"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="rui-search-body">
                    <div class="row vertical-gap">
                        <div class="col-12 col-md-6 col-lg-4">
                            <h4>Members</h4>
                            <a href="#" class="media media-success"
                                ><span class="media-img"
                                    ><img src="" alt=""/></span
                                ><span class="media-body"
                                    ><span class="media-title">Helen Holt</span>
                                    <small class="media-subtitle"
                                        >Content Manager</small
                                    >
                                </span></a
                            ><a href="#" class="media media-warning"
                                ><span class="media-img"
                                    ><img src="" alt=""/></span
                                ><span class="media-body"
                                    ><span class="media-title"
                                        >Avice Harris</span
                                    >
                                    <small class="media-subtitle"
                                        >Support</small
                                    >
                                </span></a
                            ><a href="#" class="media media-success"
                                ><span class="media-img"
                                    ><img src="" alt=""/></span
                                ><span class="media-body"
                                    ><span class="media-title">Anna Rice</span>
                                    <small class="media-subtitle"
                                        >Programmer</small
                                    ></span
                                ></a
                            >
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <h4>Articles</h4>
                            <a href="#" class="media"
                                ><span class="media-img">M</span>
                                <span class="media-body"
                                    ><span class="media-title"
                                        >Minimal Design</span
                                    >
                                    <small class="media-subtitle"
                                        >Be life tree every behold fish</small
                                    >
                                </span></a
                            ><a href="#" class="media"
                                ><span class="media-img"
                                    ><span
                                        data-feather="heart"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></span>
                                <span class="media-body"
                                    ><span class="media-title"
                                        >Admin Dashboard</span
                                    >
                                    <small class="media-subtitle"
                                        >Fruit their us also rule one
                                        multiply</small
                                    >
                                </span></a
                            ><a href="#" class="media"
                                ><span class="media-img">R</span>
                                <span class="media-body"
                                    ><span class="media-title"
                                        >Responsive Design</span
                                    >
                                    <small class="media-subtitle"
                                        >Behold, to all own, one all fruitful
                                        let</small
                                    ></span
                                ></a
                            >
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <h4>Files</h4>
                            <a href="#" class="media"
                                ><span class="media-img bg-transparent"
                                    ><img
                                        src=""
                                        class="icon-file"
                                        alt=""/></span
                                ><span class="media-body"
                                    ><span class="media-title">Dashboard</span>
                                    <small class="media-subtitle"
                                        >Admin &amp; Dashboard</small
                                    >
                                </span></a
                            ><a href="#" class="media"
                                ><span class="media-img bg-transparent"
                                    ><img
                                        src=""
                                        class="icon-file"
                                        alt=""/></span
                                ><span class="media-body"
                                    ><span class="media-title"
                                        >Application</span
                                    >
                                    <small class="media-subtitle"
                                        >Application</small
                                    >
                                </span></a
                            ><a href="#" class="media"
                                ><span class="media-img bg-transparent"
                                    ><img
                                        src=""
                                        class="icon-file"
                                        alt=""/></span
                                ><span class="media-body"
                                    ><span class="media-title">Marketing</span>
                                    <small class="media-subtitle"
                                        >Landing &amp; Corporate</small
                                    ></span
                                ></a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="rui-popup rui-popup-messenger" id="messenger">
            <form class="rui-messenger rui-messenger-mini">
                <div class="rui-messenger-head">
                    <div class="input-group rui-messenger-search">
                        <button
                            type="button"
                            class="btn btn-clean btn-uniform btn-grey-5"
                            data-toggle="button"
                            aria-pressed="false"
                        >
                            <span
                                data-feather="search"
                                class="rui-icon rui-icon-stroke-1_5"
                            ></span>
                        </button>
                        <input
                            type="search"
                            class="form-control form-control-clean"
                            placeholder="Type to search..."
                            data-toggle="input"
                            autocomplete="off"
                        />
                    </div>

                    <h4 class="mnb-2">Messenger</h4>
                </div>
                <div class="rui-messenger-list rui-scrollbar">
                    <a
                        class="btn rui-messenger-collapse-btn"
                        data-toggle="collapse"
                        href="#collapseOnline"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseOnline"
                        >Online
                        <span
                            data-feather="chevron-right"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span
                    ></a>
                    <div class="collapse show" id="collapseOnline">
                        <div class="rui-messenger-collapse">
                            <div class="media media-success media-filled">
                                <a
                                    href="#"
                                    class="media-link rui-messenger-item"
                                    ><span class="media-img"
                                        ><img src="" alt=""/></span
                                    ><span class="media-body"
                                        ><span class="media-title"
                                            >Amber Smith</span
                                        >
                                        <small class="media-subtitle"
                                            >Bring abundantly creature great
                                            behold...</small
                                        >
                                    </span></a
                                ><a href="#" class="media-icon"
                                    ><span
                                        data-feather="x"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></a>
                            </div>
                            <div class="media media-success media-filled">
                                <a
                                    href="#"
                                    class="media-link rui-messenger-item"
                                    ><span class="media-img">F</span>
                                    <span class="media-body"
                                        ><span class="media-title"
                                            >Frank Eaton</span
                                        >
                                        <small class="media-subtitle"
                                            >Porttitor facilisis quisque
                                            ultrices...</small
                                        >
                                    </span></a
                                ><a href="#" class="media-icon"
                                    ><span
                                        data-feather="x"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></a>
                            </div>
                        </div>
                    </div>
                    <a
                        class="btn rui-messenger-collapse-btn collapsed"
                        data-toggle="collapse"
                        href="#collapseOffline"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseOffline"
                        >Offline
                        <span
                            data-feather="chevron-right"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span
                    ></a>
                    <div class="collapse" id="collapseOffline">
                        <div class="rui-messenger-collapse">
                            <div class="media media-warning media-filled">
                                <a
                                    href="#"
                                    class="media-link rui-messenger-item"
                                    ><span class="media-img"
                                        ><img src="" alt=""/></span
                                    ><span class="media-body"
                                        ><span class="media-title"
                                            >Helen Holt</span
                                        >
                                        <small class="media-subtitle"
                                            >Upon us after sixth, under is
                                            appear...</small
                                        >
                                    </span></a
                                ><a href="#" class="media-icon"
                                    ><span
                                        data-feather="x"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></a>
                            </div>
                            <div class="media media-warning media-filled">
                                <a
                                    href="#"
                                    class="media-link rui-messenger-item"
                                    ><span class="media-img">S</span>
                                    <span class="media-body"
                                        ><span class="media-title"
                                            >Steven Cross</span
                                        >
                                        <small class="media-subtitle"
                                            >Us earth our sixth cattle great
                                            without...</small
                                        >
                                    </span></a
                                ><a href="#" class="media-icon"
                                    ><span
                                        data-feather="x"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rui-messenger-footer">
                    <button type="button" class="btn btn-custom-round">
                        <span
                            data-feather="more-vertical"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span>
                    </button>
                    <button
                        type="button"
                        class="btn btn-brand btn-uniform btn-round btn-sm"
                    >
                        <span
                            data-feather="plus"
                            class="rui-icon rui-icon-stroke-1_5"
                        ></span>
                    </button>
                </div>
                <div class="rui-messenger-chat">
                    <div class="rui-messenger-head">
                        <a
                            href="#"
                            class="btn btn-clean btn-uniform btn-grey-5 rui-messenger-back"
                            ><span
                                data-feather="chevron-left"
                                class="rui-icon rui-icon-stroke-1_5"
                            ></span
                        ></a>
                        <h4 class="mnb-4">Amber Smith</h4>
                        <div class="rui-messenger-head-empty"></div>
                    </div>
                    <div class="rui-messenger-body rui-scrollbar">
                        <div>
                            <div
                                class="rui-messenger-message rui-messenger-message-structure"
                            >
                                <ul>
                                    <li></li>
                                </ul>
                                <div class="rui-messenger-message-edit">
                                    <a href="#" class="btn"
                                        ><span
                                            data-feather="edit-2"
                                            class="rui-icon rui-icon-stroke-1_5"
                                        ></span
                                    ></a>
                                    <a href="#" class="btn"
                                        ><span
                                            data-feather="trash"
                                            class="rui-icon rui-icon-stroke-1_5"
                                        ></span
                                    ></a>
                                </div>
                                <small
                                    class="rui-messenger-message-time"
                                ></small>
                            </div>
                            <small class="rui-messenger-message-datetime"
                                >2 days ago</small
                            >
                            <div
                                class="rui-messenger-message rui-messenger-message-incoming"
                            >
                                <ul>
                                    <li>The last album.</li>
                                    <li>I can’t open the last album!</li>
                                </ul>
                                <small class="rui-messenger-message-time"
                                    >10:19</small
                                >
                            </div>
                            <div
                                class="rui-messenger-message rui-messenger-message-incoming"
                            >
                                <ul>
                                    <li>
                                        Gues, I can’t open the last album...
                                    </li>
                                </ul>
                                <small class="rui-messenger-message-time"
                                    >10:20</small
                                >
                            </div>
                            <small class="rui-messenger-message-datetime"
                                >Today</small
                            >
                            <div class="rui-messenger-message">
                                <ul>
                                    <li>123</li>
                                </ul>
                                <small class="rui-messenger-message-time"
                                    >10:29</small
                                >
                                <div class="rui-messenger-message-edit">
                                    <a href="#" class="btn"
                                        ><span
                                            data-feather="edit-2"
                                            class="rui-icon rui-icon-stroke-1_5"
                                        ></span
                                    ></a>
                                    <a href="#" class="btn"
                                        ><span
                                            data-feather="trash"
                                            class="rui-icon rui-icon-stroke-1_5"
                                        ></span
                                    ></a>
                                </div>
                            </div>
                            <div class="rui-messenger-message">
                                <ul>
                                    <li>
                                        Haha Amber! You are so nice! :smile:
                                    </li>
                                </ul>
                                <small class="rui-messenger-message-time"
                                    >10:30</small
                                >
                                <div class="rui-messenger-message-edit">
                                    <a href="#" class="btn"
                                        ><span
                                            data-feather="edit-2"
                                            class="rui-icon rui-icon-stroke-1_5"
                                        ></span
                                    ></a>
                                    <a href="#" class="btn"
                                        ><span
                                            data-feather="trash"
                                            class="rui-icon rui-icon-stroke-1_5"
                                        ></span
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rui-messenger-footer">
                        <div class="input-group mnt-10 mnb-10">
                            <div class="input-group-prepend mnl-2">
                                <input
                                    type="file"
                                    class="rui-messenger-custom-file"
                                    id="customFileLang"
                                    lang="es"
                                />
                                <label
                                    class="btn btn-clean btn-uniform btn-grey-5 mb-0"
                                    for="customFileLang"
                                    ><span
                                        data-feather="paperclip"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></label>
                            </div>
                            <textarea
                                class="form-control form-control-clean rui-messenger-textarea"
                                placeholder="Write a message..."
                            ></textarea>
                            <div class="input-group-append ml-2">
                                <a
                                    href="#"
                                    class="btn btn-clean btn-uniform btn-grey-5 rui-messenger-send"
                                    ><span
                                        data-feather="send"
                                        class="rui-icon rui-icon-stroke-1_5"
                                    ></span
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> -->
        <!-- <div
            class="toast rui-toast hide"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-delay="8000"
            data-toast-show-on-startup="true"
        >
            <div class="toast-header">
                <h5 class="mr-auto mnb-2">RootUI</h5>
                <small class="toast-date">15 minutes ago</small>
                <button
                    type="button"
                    class="ml-15 mnt-4 mnr-4 toast-close close"
                    data-dismiss="toast"
                    aria-label="Close"
                >
                    <span
                        data-feather="x"
                        class="rui-icon rui-icon-stroke-1_5"
                    ></span>
                </button>
            </div>
            <div class="toast-body">
                Hey, this is a demo notice. Click on the close button if you
                don't want to see it again.
            </div>
        </div> -->
    </main>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import LeftSidebar from "./components/LeftSidebar.vue";
import NewNavbar from "./components/NewNavbar.vue";
import NewFooter from "./components/NewFooter.vue";
import RightSidebar from "./components/RightSidebar.vue";
export default {
    computed: {
        ...mapState(["token"]),
        ...mapGetters(["isAuth"])
    },
    components: {
        LeftSidebar: LeftSidebar,
        NewNavbar: NewNavbar,
        NewFooter: NewFooter,
        RightSidebar: RightSidebar
    }
};
</script>
