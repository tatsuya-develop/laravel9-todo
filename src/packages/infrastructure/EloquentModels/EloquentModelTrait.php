<?php

namespace Infrastructure\EloquentModels;

/**
 * EloquentModel共通で使用するTrait
 * 本当は基底クラスとして定義して継承したかったが、User.phpは特殊な経路で継承をしていることもあり、共通の基底クラスを定義できなかった
 * そのため、Traitを定義して読み込ませる方針にした
 */
trait EloquentModelTrait
{
}
