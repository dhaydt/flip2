<template>
    <div class="list-component w-100">
        <a :href="`/details/`+id" class="card shadow-sm">
            <div class="card-header">
                <h6 class="card-title text-capitalize">{{ title }}</h6>
                <div class="d-flex justify-content-end">
                    <span class="badge bg-success rounded-pill ms-4">{{ sector }}</span>
                </div>
            </div>
            <div class="card-body">
                <img :src="cover" alt="" />
            </div>
            <div class="card-footer">
                {{ desc }}
            </div>
        </a>
    </div>
</template>

<script>
export default {
    props: ["flip"],
    mounted() {
        var storage = "/storage/" + this.flip.name + "/";
        var dataImg = [null];
        for (let i = 0; i < Number(this.flip.count); i++) {
            dataImg.push(storage + this.flip.name + "-" + i + ".jpg");
        }
        if(this.flip.count > 1){
            this.cover = storage + this.flip.name + "-0.jpg";
        }else{
            this.cover = storage + this.flip.name + ".jpg";
        }
        this.title = this.flip.title;
        this.sector = this.flip.sector;
        this.desc = this.flip.desc;
        this.id = this.flip.slug;
        console.log('slug',this.id);
    },
    data() {
        return {
            cover: "",
            title: "",
            desc: "",
            id: "",
            sector: ''
        };
    },
};
</script>

<style lang="scss" scoped>
a{
    text-decoration: none;
    color: unset;
}
.card-body img{
    width: 100%;
}
</style>
