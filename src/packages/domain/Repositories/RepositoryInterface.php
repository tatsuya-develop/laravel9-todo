<?php

namespace Domain\Repositories;

/**
 * toEntity, toModelといったMappingメソッドもメタプロで実装したいが、必ずしもRepositoryとModelが対になるわけでもない。
 * そういった点からも実装が難しいため、ChatGPTに相談した結果、各Repositoryクラスで定義してもらう方針になった。
 */
interface RepositoryInterface
{
}
