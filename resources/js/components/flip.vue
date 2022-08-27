<template>
    <div class="card shadow" id="flip">
        <div class="card-header w-100">
            <h5 class="card-title text-capitalize w-100">
                {{ title }}
            </h5>
        </div>
        <div class="card-body">
            <Flipbook
                ref="flipbook"
                class="flipbook"
                :pages="pages"
                v-slot="flipbook"
                :zooms="null"
                @flip-right-start="onFlipRightStart"
            >
                <button @click="flipbook.flipLeft" class="btn-left">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button @click="flipbook.flipRight" class="btn-right">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <!-- <p>{{ flipbook }}</p> -->
                <!-- <p @click="flipbook.page = 1">1</p>
                {{ flipbook.numPages }} -->
            </Flipbook>
        </div>
    </div>
</template>

<script>
import Flipbook from "flipbook-vue";
export default {
    props: ["flip"],
    components: {
        Flipbook,
    },
    mounted() {
        var flipData = this.flip;
        var storage = "/storage/" + this.flip.name + "/";
        var dataImg = [null];
        for (let i = 0; i < Number(this.flip.count); i++) {
            dataImg.push(storage + this.flip.name + "-" + i + ".jpg");
        }
        this.pages = dataImg;
        this.title = this.flip.title;
    },
    methods: {
        changePage() {
            this.$refs.flipbook.frontImage = this.$refs.flipbook.pageUrl(4);
            this.$refs.flipbook.backImge = this.$refs.flipbook.pageUrl(5);
            this.$refs.flipbook.firstPage = 4;
            this.$refs.flipbook.secondPage = 5;
            // this.$refs.flipbook.flipAuto(true);
        },
        onFlipRightStart(page) {
            console.log(page);
        },
    },
    data() {
        return {
            title: "",
            singlePage: false,
            pages: [],
        };
    },
};
</script>

<style>
html,
body {
    margin: 0;
    padding: 0;
}
#flip {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    /* max-height: 90vh; */
    width: 100%;
    display: flex;
    overflow: hidden;
    flex-direction: column;
    align-items: center;
    /* background-color: #333; */
    color: #ccc;
}
a {
    color: inherit;
}
.flipbook > button:first-child {
    position: absolute;
    top: 50%;
    left: 10px;
    border-radius: 50%;
    z-index: 1;
    padding: 8px 15px;
}
.flipbook > button:nth-child(2) {
    position: absolute;
    top: 50%;
    right: 10px;
    border-radius: 50%;
    padding: 8px 15px;
    z-index: 1;
}
.action-bar {
    width: 100%;
    height: 50px;
    padding: 10px 0;
    display: flex;
    justify-content: center;
    align-items: center;
}
.action-bar .btn {
    font-size: 30px;
    color: #999;
}
.action-bar .btn svg {
    bottom: 0;
}
.action-bar .btn:not(:first-child) {
    margin-left: 10px;
}
.has-mouse .action-bar .btn:hover {
    color: #ccc;
    filter: drop-shadow(1px 1px 5px #000);
    cursor: pointer;
}
.action-bar .btn:active {
    filter: none !important;
}
.btn-left.disabled {
    color: #666;
    pointer-events: none;
}
.btn-right.disabled {
    color: #666;
    pointer-events: none;
}
.action-bar .page-num {
    font-size: 12px;
    margin-left: 10px;
}
.card-body .flipbook .viewport {
    width: 80vw;
    height: calc(100vh - 50px - 40px);
}
.card-body .flipbook .bounding-box {
    box-shadow: 0 0 20px #000;
}
.credit {
    font-size: 12px;
    line-height: 20px;
    margin: 10px;
}
</style>
